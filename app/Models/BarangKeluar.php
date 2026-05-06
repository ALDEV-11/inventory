<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DetailBarangKeluar;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_keluar';
    protected $fillable = [
        'id_user', 'nomor_keluar', 'tanggal', 'tujuan', 'keterangan', 'total_nilai',
    ];
    protected $casts = [
        'tanggal' => 'date',
        'total_nilai' => 'decimal:2',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function detailBarangKeluar()
    {
        return $this->hasMany(DetailBarangKeluar::class, 'id_keluar');
    }
}
