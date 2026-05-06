<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KategoriBarangController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('manage-master');
        
        $search = $request->query('search');
        $query = KategoriBarang::query();

        if ($search) {
            $query->where('nama_kategori', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%");
        }

        $kategori = $query->latest('id_kategori')->paginate(10);
        return view('admin.master.kategori.index', compact('kategori', 'search'));
    }

    public function create()
    {
        Gate::authorize('manage-master');
        return view('admin.master.kategori.form');
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-master');
        
        $request->validate([
            'nama_kategori' => 'required|max:100',
            'deskripsi' => 'nullable',
        ]);

        KategoriBarang::create($request->all());

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        Gate::authorize('manage-master');
        $kategori = KategoriBarang::findOrFail($id);
        return view('admin.master.kategori.form', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('manage-master');
        $kategori = KategoriBarang::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|max:100',
            'deskripsi' => 'nullable',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Gate::authorize('manage-master');
        $kategori = KategoriBarang::findOrFail($id);

        // Cek apakah kategori masih digunakan di tabel barang
        $isUsed = Barang::where('id_kategori', $id)->exists();

        if ($isUsed) {
            return redirect()->route('kategori-barang.index')->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh data barang.');
        }

        $kategori->delete();

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
