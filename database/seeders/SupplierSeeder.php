<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('supplier')->insert([
            [
                'kode_supplier' => 'SUP-001',
                'nama_supplier' => 'PT Sumber Elektronik',
                'alamat' => 'Jl. Merdeka No. 1, Jakarta',
                'no_telp' => '0211234567',
                'email' => 'info@sumberelektronik.com',
                'pic' => 'Budi Santoso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_supplier' => 'SUP-002',
                'nama_supplier' => 'CV Alat Tulis Jaya',
                'alamat' => 'Jl. Sudirman No. 10, Bandung',
                'no_telp' => '0227654321',
                'email' => 'admin@alattulisjaya.co.id',
                'pic' => 'Siti Aminah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_supplier' => 'SUP-003',
                'nama_supplier' => 'UD Bahan Baku Makmur',
                'alamat' => 'Jl. Diponegoro No. 5, Surabaya',
                'no_telp' => '0319988776',
                'email' => 'kontak@bahanbakumakmur.com',
                'pic' => 'Andi Wijaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
