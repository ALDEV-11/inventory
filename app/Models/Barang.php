<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriBarang;
use App\Models\DetailBarangMasuk;
use App\Models\DetailBarangKeluar;
use App\Models\DetailRetur;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_kategori', 'kode_barang', 'nama_barang', 'satuan', 'harga_beli', 'harga_jual', 'stok_min', 'stok_saat_ini', 'gambar',
    ];
    protected $casts = [
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2',
    ];
    public function kategoriBarang()
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategori');
    }
    public function detailBarangMasuk()
    {
        return $this->hasMany(DetailBarangMasuk::class, 'id_barang');
    }
    public function detailBarangKeluar()
    {
        return $this->hasMany(DetailBarangKeluar::class, 'id_barang');
    }
    public function detailRetur()
    {
        return $this->hasMany(DetailRetur::class, 'id_barang');
    }
}
