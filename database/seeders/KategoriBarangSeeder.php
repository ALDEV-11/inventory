<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_barang')->insert([
            ['nama_kategori' => 'Elektronik', 'deskripsi' => 'Barang-barang elektronik', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Alat Tulis', 'deskripsi' => 'Perlengkapan alat tulis kantor', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Bahan Baku', 'deskripsi' => 'Bahan baku produksi', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Peralatan', 'deskripsi' => 'Peralatan kerja', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Lainnya', 'deskripsi' => 'Kategori lainnya', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
