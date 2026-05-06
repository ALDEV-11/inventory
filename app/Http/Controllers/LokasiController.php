<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\DetailBarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('manage-master');
        
        $search = $request->query('search');
        $query = Lokasi::query();

        if ($search) {
            $query->where('nama_lokasi', 'LIKE', "%{$search}%")
                  ->orWhere('kode_rak', 'LIKE', "%{$search}%");
        }

        $lokasi = $query->latest('id_lokasi')->paginate(10);
        return view('admin.master.lokasi.index', compact('lokasi', 'search'));
    }

    public function create()
    {
        Gate::authorize('manage-master');
        return view('admin.master.lokasi.form');
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-master');
        
        $request->validate([
            'kode_rak' => 'required|max:20|unique:lokasi,kode_rak',
            'nama_lokasi' => 'required|max:100',
            'deskripsi' => 'nullable',
        ]);

        Lokasi::create($request->all());

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        Gate::authorize('manage-master');
        $lokasi = Lokasi::findOrFail($id);
        return view('admin.master.lokasi.form', compact('lokasi'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('manage-master');
        $lokasi = Lokasi::findOrFail($id);

        $request->validate([
            'kode_rak' => 'required|max:20|unique:lokasi,kode_rak,' . $id . ',id_lokasi',
            'nama_lokasi' => 'required|max:100',
            'deskripsi' => 'nullable',
        ]);

        $lokasi->update($request->all());

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Gate::authorize('manage-master');
        $lokasi = Lokasi::findOrFail($id);

        // Cek apakah lokasi masih digunakan di detail_barang_masuk
        $isUsed = DetailBarangMasuk::where('id_lokasi', $id)->exists();

        if ($isUsed) {
            return redirect()->route('lokasi.index')->with('error', 'Lokasi tidak dapat dihapus karena masih digunakan dalam data transaksi.');
        }

        $lokasi->delete();

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}
