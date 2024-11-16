<?php

namespace Database\Seeders;

use App\Models\KategoriBidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriBidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBidang::create([
            'id' => 1,
            'nama_kategori' => 'Web Developer',
        ]);
        KategoriBidang::create([
            'id' => 2,
            'nama_kategori' => 'Mobile Developer',
        ]);
        KategoriBidang::create([
            'id' => 3,
            'nama_kategori' => 'Pertanian',
        ]);
        KategoriBidang::create([
            'id' => 4,
            'nama_kategori' => 'Perhotelan',
        ]);
    }
}
