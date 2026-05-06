<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DetailRetur;

class ReturBarang extends Model
{
    use HasFactory;
    protected $table = 'retur_barang';
    protected $primaryKey = 'id_retur';
    protected $fillable = [
        'id_user', 'nomor_retur', 'jenis', 'tanggal', 'alasan', 'total_nilai',
    ];
    protected $casts = [
        'tanggal' => 'date',
        'total_nilai' => 'decimal:2',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function detailRetur()
    {
        return $this->hasMany(DetailRetur::class, 'id_retur');
    }
}
