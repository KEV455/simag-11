<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Semester
        Semester::create([
            'id' => 1,
            'kode_semester' => '20231',
            'nama_semester' => '2023/2024 Ganjil',
            'semester' => "1",
            'tahun_ajaran' => "2023",
        ]);
        Semester::create([
            'id' => 2,
            'kode_semester' => '20232',
            'nama_semester' => '2023/2024 Genap',
            'semester' => "2",
            'tahun_ajaran' => "2023",
        ]);
        Semester::create([
            'id' => 3,
            'kode_semester' => '20241',
            'nama_semester' => '2024/2025 Ganjil',
            'semester' => "1",
            'tahun_ajaran' => "2024",
        ]);
        Semester::create([
            'id' => 4,
            'kode_semester' => '20242',
            'nama_semester' => '2024/2025 Genap',
            'semester' => "2",
            'tahun_ajaran' => "2024",
        ]);
        Semester::create([
            'id' => 5,
            'kode_semester' => '20251',
            'nama_semester' => '2025/2026 Ganjil',
            'semester' => "1",
            'tahun_ajaran' => "2025",
        ]);
        Semester::create([
            'id' => 6,
            'kode_semester' => '20252',
            'nama_semester' => '2025/2026 Genap',
            'semester' => "2",
            'tahun_ajaran' => "2025",
        ]);
    }
}
