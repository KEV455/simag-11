<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // mahasiswa
        User::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // mahasiswa
        User::create([
            'name' => 'Andi Lutfi',
            'username' => '362055401010',
            'email' => 'andi@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'mahasiswa',
        ]);

        // dospem
        User::create([
            'name' => 'Farizky Panduardi',
            'username' => 'farizky',
            'email' => 'farizky@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'dospem',
        ]);

        // kaprodi
        User::create([
            'name' => 'Dianni Yusuf',
            'username' => 'dianni',
            'email' => 'dianni@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'kaprodi',
        ]);

        // koordinator
        User::create([
            'name' => 'Lukman Hakim',
            'username' => 'lukman',
            'email' => 'lukman@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'koordinator',
        ]);
    }
}
