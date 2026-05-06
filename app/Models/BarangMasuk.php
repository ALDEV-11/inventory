<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\User;
use App\Models\DetailBarangMasuk;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_masuk';
    protected $fillable = [
        'id_supplier', 'id_user', 'nomor_po', 'tanggal', 'status', 'total_nilai', 'keterangan', 'approved_by', 'approved_at',
    ];
    protected $casts = [
        'tanggal' => 'date',
        'approved_at' => 'datetime',
        'total_nilai' => 'decimal:2',
        'status' => 'string',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function detailBarangMasuk()
    {
        return $this->hasMany(DetailBarangMasuk::class, 'id_masuk');
    }
}
