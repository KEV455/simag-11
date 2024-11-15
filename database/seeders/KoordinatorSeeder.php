<?php

namespace Database\Seeders;

use App\Models\Koordinator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Koordinator
        Koordinator::create([
            'id' => 1,
            'nama' => 'Lukman Hakim',
            'email' => 'lukman@gmail.com',
            'nomor_telp' => '081234567890',
            'id_user' => 5,
        ]);
    }
}
