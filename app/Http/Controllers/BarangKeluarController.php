<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\DetailBarangKeluar;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Notifications\StokMinimumNotification;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = BarangKeluar::with(['user'])->orderBy('created_at', 'desc');

        if ($search) {
            $query->where('nomor_keluar', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%")
                  ->orWhere('tujuan', 'like', "%{$search}%");
        }

        $barangKeluar = $query->paginate(10);
        return view('barang-keluar.index', compact('barangKeluar', 'search'));
    }

    public function create()
    {
        // Only get active items that have stock
        $barang = Barang::where('stok_saat_ini', '>', 0)->get();
        
        $today = date('Ymd');
        $lastBk = BarangKeluar::whereDate('created_at', today())->count();
        $nomorKeluar = 'BK-' . $today . '-' . str_pad($lastBk + 1, 3, '0', STR_PAD_LEFT);

        return view('barang-keluar.create', compact('barang', 'nomorKeluar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tujuan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'nomor_keluar' => 'required|unique:barang_keluar,nomor_keluar',
            'details' => 'required|array|min:1',
            'details.*.id_barang' => 'required|exists:barang,id_barang',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $totalNilai = 0;
            $detailsData = [];
            $lowStockItems = [];

            // Preliminary check for stock availability
            foreach ($request->details as $detail) {
                $barang = Barang::lockForUpdate()->find($detail['id_barang']);
                
                if ($barang->stok_saat_ini < $detail['jumlah']) {
                    DB::rollback();
                    return redirect()->back()
                        ->with('error', "Stok {$barang->nama_barang} tidak mencukupi. Stok tersedia: {$barang->stok_saat_ini}")
                        ->withInput();
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
            $barangKeluar = BarangKeluar::create([
                'id_user' => Auth::id(),
                'nomor_keluar' => $request->nomor_keluar,
                'tanggal' => $request->tanggal,
                'tujuan' => $request->tujuan,
                'total_nilai' => $totalNilai,
                'keterangan' => $request->keterangan,
            ]);

            // Get users to notify (admin and kepala)
            $notifiableUsers = User::whereIn('role', ['admin', 'kepala'])->get();

            // Create Details & Deduct Stock
            foreach ($detailsData as $detail) {
                $barang = $detail['barang_model'];
                
                // Insert detail
                DetailBarangKeluar::create([
                    'id_keluar' => $barangKeluar->id_keluar,
                    'id_barang' => $detail['id_barang'],
                    'jumlah' => $detail['jumlah'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'subtotal' => $detail['subtotal'],
                ]);

                // Deduct stock
                $barang->decrement('stok_saat_ini', $detail['jumlah']);
                
                // Refresh to check new stock level against minimum
                $barang->refresh();
                if ($barang->stok_saat_ini <= $barang->stok_min) {
                    // Notify each relevant user for this specific low stock item
                    foreach ($notifiableUsers as $user) {
                        $user->notify(new StokMinimumNotification($barang));
                    }
                }
            }

            DB::commit();
            return redirect()->route('barang-keluar.index')->with('success', 'Barang Keluar berhasil dicatat.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $barangKeluar = BarangKeluar::with(['user', 'detailBarangKeluar.barang'])->findOrFail($id);
        return view('barang-keluar.show', compact('barangKeluar'));
    }

    public function checkStock($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json([
            'stok_saat_ini' => $barang->stok_saat_ini,
            'harga_jual' => $barang->harga_jual // Useful to pre-fill the form if needed
        ]);
    }
}
