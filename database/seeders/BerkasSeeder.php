<?php

namespace Database\Seeders;

use App\Models\Berkas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BerkasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Berkas::create([
            'id' => 1,
            'nama_berkas' => 'KHS Semester 1 - 6',
            'status' => 'wajib',
        ]);
        Berkas::create([
            'id' => 2,
            'nama_berkas' => 'Bukti Herregistrasi Semester 6',
            'status' => 'wajib',
        ]);
    }
}
