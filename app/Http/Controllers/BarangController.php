<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\DetailBarangMasuk;
use App\Models\DetailBarangKeluar;
use App\Models\DetailRetur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Barang::with('kategoriBarang');

        if ($search) {
            $query->where('nama_barang', 'LIKE', "%{$search}%")
                  ->orWhere('kode_barang', 'LIKE', "%{$search}%");
        }

        $barang = $query->latest()->paginate(10);
        return view('barang.index', compact('barang', 'search'));
    }

    public function create()
    {
        $kategori = KategoriBarang::all();
        return view('barang.form', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori_barang,id_kategori',
            'kode_barang' => 'nullable|max:20|unique:barang,kode_barang',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok_min' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Auto-generate kode_barang if empty
        if (!$request->kode_barang) {
            $lastBarang = Barang::orderBy('id_barang', 'desc')->first();
            $lastNum = $lastBarang ? (int) substr($lastBarang->kode_barang, 4) : 0;
            $data['kode_barang'] = 'BRG-' . str_pad($lastNum + 1, 3, '0', STR_PAD_LEFT);
        }

        // Initialize stok_saat_ini to 0
        $data['stok_saat_ini'] = 0;

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $barang = Barang::with('kategoriBarang')->findOrFail($id);

        // Get transaction history
        $userId = auth()->id();
        $history = DetailBarangMasuk::where('id_barang', $id)
            ->join('barang_masuk', 'detail_barang_masuk.id_masuk', '=', 'barang_masuk.id_masuk')
            ->select('barang_masuk.nomor_po as nomor', 'barang_masuk.tanggal', DB::raw("'Masuk' as jenis"), 'detail_barang_masuk.jumlah')
            ->union(
                DetailBarangKeluar::where('id_barang', $id)
                    ->join('barang_keluar', 'detail_barang_keluar.id_keluar', '=', 'barang_keluar.id_keluar')
                    ->select('barang_keluar.nomor_keluar as nomor', 'barang_keluar.tanggal', DB::raw("'Keluar' as jenis"), 'detail_barang_keluar.jumlah')
            )
            ->union(
                DetailRetur::where('id_barang', $id)
                    ->join('retur_barang', 'detail_retur.id_retur', '=', 'retur_barang.id_retur')
                    ->select('retur_barang.nomor_retur as nomor', 'retur_barang.tanggal', DB::raw("'Retur' as jenis"), 'detail_retur.jumlah')
            )
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('barang.show', compact('barang', 'history'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = KategoriBarang::all();
        return view('barang.form', compact('barang', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'id_kategori' => 'required|exists:kategori_barang,id_kategori',
            'kode_barang' => 'required|max:20|unique:barang,kode_barang,' . $id . ',id_barang',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok_min' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Delete image
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
