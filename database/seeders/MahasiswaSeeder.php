<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'id' => 1,
            'nim' => '362055401010',
            'nama_mahasiswa' => 'Andi Lutfi',
            'email' => 'andi@gmail.com',
            'angkatan' => '2020',
            'jenis_kelamin' => 'L',
            'id_prodi' => 1,
            'id_user' => 2,
        ]);
    }
}
