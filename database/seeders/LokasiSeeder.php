<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lokasi')->insert([
            ['kode_rak' => 'RAK-A1', 'nama_lokasi' => 'Rak A1', 'deskripsi' => 'Rak bagian depan A1', 'created_at' => now(), 'updated_at' => now()],
            ['kode_rak' => 'RAK-A2', 'nama_lokasi' => 'Rak A2', 'deskripsi' => 'Rak bagian depan A2', 'created_at' => now(), 'updated_at' => now()],
            ['kode_rak' => 'RAK-B1', 'nama_lokasi' => 'Rak B1', 'deskripsi' => 'Rak bagian tengah B1', 'created_at' => now(), 'updated_at' => now()],
            ['kode_rak' => 'RAK-B2', 'nama_lokasi' => 'Rak B2', 'deskripsi' => 'Rak bagian tengah B2', 'created_at' => now(), 'updated_at' => now()],
            ['kode_rak' => 'RAK-C1', 'nama_lokasi' => 'Rak C1', 'deskripsi' => 'Rak bagian belakang C1', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
