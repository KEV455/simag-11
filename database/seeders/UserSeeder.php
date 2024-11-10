<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Mahasiswa Example',
            'username' => 'mahasiswa1',
            'email' => 'mahasiswa@example.com',
            'phone' => '081234567890',
            'department' => 'Teknik Informatika',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Dospem Example',
            'username' => 'dospem1',
            'email' => 'dospem@example.com',
            'phone' => '081234567891',
            'department' => 'Teknik Informatika',
            'password' => Hash::make('password123'),
            'role' => 'dospem',
        ]);

        User::create([
            'name' => 'Kaprodi Example',
            'username' => 'kaprodi1',
            'email' => 'kaprodi@example.com',
            'phone' => '081234567891',
            'department' => 'Teknik Informatika',
            'password' => Hash::make('password123'),
            'role' => 'kaprodi',
        ]);

        User::create([
            'name' => 'Koordinator Example',
            'username' => 'Koordinator1',
            'email' => 'Koordinator@example.com',
            'phone' => '081234567891',
            'department' => 'Teknik Informatika',
            'password' => Hash::make('password123'),
            'role' => 'Koordinator',
        ]);

    }
}
