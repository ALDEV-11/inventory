<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRetur extends Model
{
    use HasFactory;
    protected $table = 'detail_retur';
    protected $primaryKey = 'id_detail';
    protected $fillable = [
        'id_retur', 'id_barang', 'jumlah', 'harga_satuan', 'subtotal',
    ];
    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];
    public function returBarang()
    {
        return $this->belongsTo(ReturBarang::class, 'id_retur');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
