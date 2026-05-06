<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'detail_barang_masuk';
    protected $primaryKey = 'id_detail';
    protected $fillable = [
        'id_masuk', 'id_barang', 'id_lokasi', 'jumlah', 'harga_satuan', 'subtotal',
    ];
    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];
    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'id_masuk');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
}
