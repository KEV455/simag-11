<?php

namespace Database\Seeders;

use App\Models\KriteriaPenilaian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaPenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Kriteria Penilaian
        KriteriaPenilaian::create([
            'id' => 1,
            'nama_kriteria_penilaian' => 'Kerjasama',
            'semester' => true,
        ]);
        KriteriaPenilaian::create([
            'id' => 2,
            'nama_kriteria_penilaian' => 'Motivasi',
            'semester' => true,
        ]);
        KriteriaPenilaian::create([
            'id' => 3,
            'nama_kriteria_penilaian' => 'Disiplin',
            'semester' => true,
        ]);
        KriteriaPenilaian::create([
            'id' => 4,
            'nama_kriteria_penilaian' => 'Etika',
            'semester' => true,
        ]);
    }
}
