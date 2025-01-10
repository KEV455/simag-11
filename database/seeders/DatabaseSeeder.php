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
        $this->call([
            UserSeeder::class,
            JurusanSeeder::class,
            ProdiSeeder::class,
            KoordinatorSeeder::class,
            KategoriBidangSeeder::class,
            BerkasSeeder::class,
            KaprodiSeeder::class,
            MahasiswaSeeder::class,
            SemesterSeeder::class,
            TahunAjaranSeeder::class,
        ]);
    }
}
