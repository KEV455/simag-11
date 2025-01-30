<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // admin
        User::create([
            'id' => 1,
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // mahasiswa
        User::create([
            'id' => 2,
            'name' => 'Andi Lutfi',
            'username' => '362055401010',
            'email' => 'andi@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'mahasiswa',
        ]);

        // dospem
        User::create([
            'id' => 3,
            'name' => 'Farizky Panduardi',
            'username' => 'farizky',
            'email' => 'farizky@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'dospem',
        ]);

        // kaprodi
        User::create([
            'id' => 4,
            'name' => 'Dianni Yusuf',
            'username' => 'dianni',
            'email' => 'dianni@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'kaprodi',
        ]);

        // koordinator
        User::create([
            'id' => 5,
            'name' => 'Lukman Hakim',
            'username' => 'lukman',
            'email' => 'lukman@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'koordinator',
        ]);
    }
}
