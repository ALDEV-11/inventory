<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'detail_barang_keluar';
    protected $primaryKey = 'id_detail';
    protected $fillable = [
        'id_keluar', 'id_barang', 'jumlah', 'harga_satuan', 'subtotal',
    ];
    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];
    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class, 'id_keluar');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
