<?php

namespace App\Http\Controllers;

use App\Models\ReturBarang;
use App\Models\DetailRetur;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StokMinimumNotification;

class ReturBarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = ReturBarang::with(['user'])->orderBy('created_at', 'desc');

        if ($search) {
            $query->where('nomor_retur', 'like', "%{$search}%")
                  ->orWhere('alasan', 'like', "%{$search}%");
        }

        $returBarang = $query->paginate(10);
        return view('retur-barang.index', compact('returBarang', 'search'));
    }

    public function create()
    {
        $barang = Barang::all();
        $today = date('Ymd');
        $lastRtr = ReturBarang::whereDate('created_at', today())->count();
        $nomorRetur = 'RTR-' . $today . '-' . str_pad($lastRtr + 1, 3, '0', STR_PAD_LEFT);

        return view('retur-barang.create', compact('barang', 'nomorRetur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Dari Pelanggan,Ke Supplier',
            'tanggal' => 'required|date',
            'alasan' => 'nullable|string',
            'nomor_retur' => 'required|unique:retur_barang,nomor_retur',
            'details' => 'required|array|min:1',
            'details.*.id_barang' => 'required|exists:barang,id_barang',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $totalNilai = 0;
            $detailsData = [];
            
            // Get users to notify (admin and kepala)
            $notifiableUsers = User::whereIn('role', ['admin', 'kepala'])->get();

            // Preliminary check for stock availability if 'Ke Supplier'
            foreach ($request->details as $detail) {
                $barang = Barang::lockForUpdate()->find($detail['id_barang']);
                
                if ($request->jenis === 'Ke Supplier') {
                    if ($barang->stok_saat_ini < $detail['jumlah']) {
                        DB::rollback();
                        return redirect()->back()
                            ->with('error', "Stok {$barang->nama_barang} tidak mencukupi untuk diretur ke supplier. Stok tersedia: {$barang->stok_saat_ini}")
                            ->withInput();
                    }
                }

                $subtotal = $detail['jumlah'] * $detail['harga_satuan'];
                $totalNilai += $subtotal;
                
                $detailsData[] = [
                    'id_barang' => $detail['id_barang'],
                    'jumlah' => $detail['jumlah'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'subtotal' => $subtotal,
                    'barang_model' => $barang 
                ];
            }

            // Create Header
            $returBarang = ReturBarang::create([
                'id_user' => Auth::id(),
                'nomor_retur' => $request->nomor_retur,
                'jenis' => $request->jenis,
                'tanggal' => $request->tanggal,
                'total_nilai' => $totalNilai,
                'alasan' => $request->alasan,
            ]);

            // Create Details & Adjust Stock
            foreach ($detailsData as $detail) {
                $barang = $detail['barang_model'];
                
                // Insert detail
                DetailRetur::create([
                    'id_retur' => $returBarang->id_retur,
                    'id_barang' => $detail['id_barang'],
                    'jumlah' => $detail['jumlah'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'subtotal' => $detail['subtotal'],
                ]);

                // Adjust stock based on transaction type
                if ($request->jenis === 'Dari Pelanggan') {
                    // Goods coming back IN
                    $barang->increment('stok_saat_ini', $detail['jumlah']);
                } else {
                    // Goods going OUT
                    $barang->decrement('stok_saat_ini', $detail['jumlah']);
                    
                    // Refresh and check if it dropped below minimum
                    $barang->refresh();
                    if ($barang->stok_saat_ini <= $barang->stok_min) {
                        foreach ($notifiableUsers as $user) {
                            $user->notify(new StokMinimumNotification($barang));
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('retur-barang.index')->with('success', 'Transaksi Retur Barang berhasil dicatat.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $returBarang = ReturBarang::with(['user', 'detailRetur.barang'])->findOrFail($id);
        return view('retur-barang.show', compact('returBarang'));
    }
}
