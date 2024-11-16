<?php

namespace Database\Seeders;

use App\Models\Kaprodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kaprodi::create([
            'id' => 1,
            'periode_mulai' => '2024-11-16',
            'periode_selesai' => '2025-11-15',
            'status' => 'Aktif',
            'id_prodi' => 1, // TRPL
            'id_user' => 4, // Diannni Yusuf
        ]);
    }
}
