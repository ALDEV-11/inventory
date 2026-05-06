<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gudang.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'petugas',
                'email' => 'petugas@gudang.com',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'kepala',
                'email' => 'kepala@gudang.com',
                'password' => Hash::make('kepala123'),
                'role' => 'kepala',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
