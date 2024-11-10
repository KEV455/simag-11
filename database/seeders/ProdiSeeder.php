<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Jurusan Bisnis dan Informatika
        Prodi::create([
            'id' => 1,
            'nama_program_studi' => 'Terapan Teknologi Rekayasa Perangkat Lunak',
            'jenjang_pendidikan' => 'S1',
            'id_jurusan' => 1,
        ]);
        Prodi::create([
            'id' => 2,
            'nama_program_studi' => 'Terapan dan Bisnis Digital',
            'jenjang_pendidikan' => 'S1',
            'id_jurusan' => 1,
        ]);
        Prodi::create([
            'id' => 3,
            'nama_program_studi' => 'Terapan Teknologi Rekayasa Komputer',
            'jenjang_pendidikan' => 'S1',
            'id_jurusan' => 1,
        ]);

        // Jurusan Teknik Sipil
        Prodi::create([
            'id' => 4,
            'nama_program_studi' => 'Teknik Sipil',
            'jenjang_pendidikan' => 'D3',
            'id_jurusan' => 2,
        ]);
        Prodi::create([
            'id' => 5,
            'nama_program_studi' => 'Terapan Teknologi Rekayasa Konstruksi Jalan & Jembatan',
            'jenjang_pendidikan' => 'S1',
            'id_jurusan' => 2,
        ]);

        // Jurusan Teknik Mesin
        Prodi::create([
            'id' => 6,
            'nama_program_studi' => 'Terapan Teknologi Rekayasa Manufaktur',
            'jenjang_pendidikan' => 'S1',
            'id_jurusan' => 3,
        ]);
        Prodi::create([
            'id' => 7,
            'nama_program_studi' => 'Terapan Teknik Manufaktur Kapal',
            'jenjang_pendidikan' => 'S1',
            'id_jurusan' => 3,
        ]);

        // Jurusan Teknik Pertanian
        Prodi::create([
            'id' => 8,
            'nama_program_studi' => 'Terapan Agribisnis',
            'jenjang_pendidikan' => 'S1',
            'id_jurusan' => 4,
        ]);
        Prodi::create([
            'id' => 9,
            'nama_program_studi' => 'Terapan Teknologi Pengolahan Hasil Ternak',
            'jenjang_pendidikan' => 'S1',
            'id_jurusan' => 4,
        ]);

        // Jurusan Pariwisata
        Prodi::create([
            'id' => 10,
            'nama_program_studi' => 'Terapan Manajemen Bisnis Pariwisata',
            'jenjang_pendidikan' => 'S1',
            'id_jurusan' => 5,
        ]);
        Prodi::create([
            'id' => 11,
            'nama_program_studi' => 'Terapan Destinasi Pariwisata',
            'jenjang_pendidikan' => 'S1',
            'id_jurusan' => 5,
        ]);
    }
}
