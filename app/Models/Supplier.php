<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BarangMasuk;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $fillable = [
        'kode_supplier', 'nama_supplier', 'alamat', 'no_telp', 'email', 'pic',
    ];
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_supplier');
    }
}
