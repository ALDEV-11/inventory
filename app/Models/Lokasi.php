<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailBarangMasuk;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $primaryKey = 'id_lokasi';
    protected $fillable = [
        'kode_rak', 'nama_lokasi', 'deskripsi',
    ];
    public function detailBarangMasuk()
    {
        return $this->hasMany(DetailBarangMasuk::class, 'id_lokasi');
    }
}
