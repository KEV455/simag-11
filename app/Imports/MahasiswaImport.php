<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;

class MahasiswaImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        // Ambil semua data prodi
        $prodis = Prodi::all();

        foreach ($rows as $index => $column) {
            // Lewati baris pertama jika itu adalah header
            if ($index === 0) {
                continue;
            }

            // Validasi apakah kolom minimal memiliki 6 elemen
            if (count($column) < 6) {
                continue; // Lewati baris jika tidak sesuai format
            }

            $kode_prodi = trim($column[5]);
            $nim = $column[0];

            // Cari data prodi berdasarkan kode prodi
            $matchingProdi = $prodis->firstWhere('kode_prodi', $kode_prodi);

            // Jika prodi tidak ditemukan, lewati baris
            if (!$matchingProdi) {
                continue;
            }

            // Cek apakah mahasiswa sudah ada berdasarkan NIM
            $mahasiswa = Mahasiswa::where('nim', $nim)->first();

            if (!$mahasiswa) {
                // Buat user baru untuk mahasiswa
                $user_mahasiswa = User::create([
                    'name' => $column[1],
                    'email' => $column[3],
                    'username' => $column[0],
                    'password' => bcrypt('12345678'),
                    'role' => 'mahasiswa',
                ]);

                // Buat data mahasiswa baru
                Mahasiswa::create([
                    'nim' => $column[0],
                    'nama_mahasiswa' => $column[1],
                    'email' => $column[3],
                    'angkatan' => $column[2],
                    'jenis_kelamin' => $column[4],
                    'id_prodi' => $matchingProdi->id,
                    'id_user' => $user_mahasiswa->id,
                ]);
            }
        }
    }
}
