<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('manage-master');
        
        $search = $request->query('search');
        $query = Supplier::query();

        if ($search) {
            $query->where('nama_supplier', 'LIKE', "%{$search}%")
                  ->orWhere('kode_supplier', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
        }

        $supplier = $query->latest('id_supplier')->paginate(10);
        return view('admin.master.supplier.index', compact('supplier', 'search'));
    }

    public function create()
    {
        Gate::authorize('manage-master');
        return view('admin.master.supplier.form');
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-master');
        
        $request->validate([
            'kode_supplier' => 'required|max:20|unique:supplier,kode_supplier',
            'nama_supplier' => 'required|max:100',
            'no_telp' => 'required|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'required',
            'pic' => 'nullable|max:100',
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit($id)
    {
        Gate::authorize('manage-master');
        $supplier = Supplier::findOrFail($id);
        return view('admin.master.supplier.form', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('manage-master');
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'kode_supplier' => 'required|max:20|unique:supplier,kode_supplier,' . $id . ',id_supplier',
            'nama_supplier' => 'required|max:100',
            'no_telp' => 'required|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'required',
            'pic' => 'nullable|max:100',
        ]);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Gate::authorize('manage-master');
        $supplier = Supplier::findOrFail($id);

        // Cek apakah supplier masih digunakan di tabel barang_masuk
        $isUsed = BarangMasuk::where('id_supplier', $id)->exists();

        if ($isUsed) {
            return redirect()->route('supplier.index')->with('error', 'Supplier tidak dapat dihapus karena masih digunakan dalam data transaksi.');
        }

        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
