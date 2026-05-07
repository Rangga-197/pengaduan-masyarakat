<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    \App\Models\Petugas::create([
        'nama_petugas' => 'Admin Utama',
        'username' => 'admin',
        'password' => bcrypt('password123'), // Password-nya: password123
        'telp' => '081234567890',
        'level' => 'admin',
    ]);
}
}
