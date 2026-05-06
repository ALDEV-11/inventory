<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = BarangMasuk::with(['supplier', 'user', 'approvedBy'])->orderBy('created_at', 'desc');

        if ($search) {
            $query->where('nomor_po', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%")
                  ->orWhereHas('supplier', function ($q) use ($search) {
                      $q->where('nama_supplier', 'like', "%{$search}%");
                  });
        }

        $barangMasuk = $query->paginate(10);
        return view('barang-masuk.index', compact('barangMasuk', 'search'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $barang = Barang::where('stok_saat_ini', '>=', 0)->get(); // Get all active items
        $lokasi = Lokasi::all();
        
        $today = date('Ymd');
        $lastPo = BarangMasuk::whereDate('created_at', today())->count();
        $nomorPo = 'PO-' . $today . '-' . str_pad($lastPo + 1, 3, '0', STR_PAD_LEFT);

        return view('barang-masuk.create', compact('suppliers', 'barang', 'lokasi', 'nomorPo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_supplier' => 'required|exists:supplier,id_supplier',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'nomor_po' => 'required|unique:barang_masuk,nomor_po',
            'details' => 'required|array|min:1',
            'details.*.id_barang' => 'required|exists:barang,id_barang',
            'details.*.id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $totalNilai = 0;
            $detailsData = [];

            foreach ($request->details as $detail) {
                $subtotal = $detail['jumlah'] * $detail['harga_satuan'];
                $totalNilai += $subtotal;
                $detailsData[] = [
                    'id_barang' => $detail['id_barang'],
                    'id_lokasi' => $detail['id_lokasi'],
                    'jumlah' => $detail['jumlah'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'subtotal' => $subtotal,
                ];
            }

            $barangMasuk = BarangMasuk::create([
                'id_supplier' => $request->id_supplier,
                'id_user' => Auth::id(),
                'nomor_po' => $request->nomor_po,
                'tanggal' => $request->tanggal,
                'status' => 'draft',
                'total_nilai' => $totalNilai,
                'keterangan' => $request->keterangan,
            ]);

            foreach ($detailsData as $detail) {
                $detail['id_masuk'] = $barangMasuk->id_masuk;
                DetailBarangMasuk::create($detail);
            }

            // TODO: Optional notification could be dispatched here

            DB::commit();
            return redirect()->route('barang-masuk.index')->with('success', 'Purchase Order berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan PO: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $barangMasuk = BarangMasuk::with(['supplier', 'user', 'approvedBy', 'detailBarangMasuk.barang', 'detailBarangMasuk.lokasi'])->findOrFail($id);
        return view('barang-masuk.show', compact('barangMasuk'));
    }

    public function approve(Request $request, $id)
    {
        if (!Gate::allows('approve-po')) {
            abort(403, 'Unauthorized action.');
        }

        $barangMasuk = BarangMasuk::findOrFail($id);
        
        if ($barangMasuk->status !== 'draft') {
            return redirect()->back()->with('error', 'Hanya PO dengan status draft yang dapat disetujui.');
        }

        $barangMasuk->update([
            'status' => 'disetujui',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('barang-masuk.show', $id)->with('success', 'Purchase Order berhasil disetujui.');
    }

    public function receive(Request $request, $id)
    {
        if (!Gate::allows('receive-po')) {
            abort(403, 'Unauthorized action.');
        }

        $barangMasuk = BarangMasuk::with('detailBarangMasuk')->findOrFail($id);

        if ($barangMasuk->status !== 'disetujui') {
            return redirect()->back()->with('error', 'Hanya PO dengan status disetujui yang dapat dikonfirmasi penerimaannya.');
        }

        try {
            DB::beginTransaction();

            $barangMasuk->update(['status' => 'diterima']);

            foreach ($barangMasuk->detailBarangMasuk as $detail) {
                $barang = Barang::findOrFail($detail->id_barang);
                $barang->increment('stok_saat_ini', $detail->jumlah);
            }

            DB::commit();
            return redirect()->route('barang-masuk.show', $id)->with('success', 'Penerimaan barang berhasil dikonfirmasi dan stok telah bertambah.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat konfirmasi penerimaan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        
        if ($barangMasuk->status !== 'draft') {
            return redirect()->route('barang-masuk.index')->with('error', 'Hanya PO dengan status draft yang dapat dihapus.');
        }

        $barangMasuk->delete();
        return redirect()->route('barang-masuk.index')->with('success', 'Purchase Order berhasil dihapus.');
    }
}
