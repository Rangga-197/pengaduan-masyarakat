<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Masukkan kode ini di sini
        $this->call([
            PetugasSeeder::class,
        ]);
    }
}