<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Mockery\Undefined;

class DosenImport implements ToCollection
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

            // Validasi apakah kolom minimal memiliki 8 elemen
            if (count($column) < 8) {
                continue; // Lewati baris jika tidak sesuai format
            }

            $kode_prodi = trim($column[7]);
            $nidn = $column[1];

            // Cari data prodi berdasarkan kode prodi
            $matchingProdi = $prodis->firstWhere('kode_prodi', $kode_prodi);

            // Jika prodi tidak ditemukan, lewati baris
            if (!$matchingProdi) {
                continue;
            }

            // Cek apakah dosen sudah ada berdasarkan NIDN
            $dosen = Dosen::where('nidn', $nidn)->first();

            if (!$dosen) {
                // Buat user baru untuk dosen
                $user_dosen = User::create([
                    'name' => $column[2],
                    'email' => $column[4],
                    'username' => $column[4],
                    'password' => bcrypt('12345678'),
                    'role' => 'dosen',
                ]);

                // Buat data dosen baru
                Dosen::create([
                    'nama_dosen' => $column[2],
                    'email' => $column[4],
                    'nomor_telp' => $column[5],
                    'jenis_kelamin' => $column[3],
                    'nip' => $column[0],
                    'nidn' => $column[1],
                    'alamat' => $column[6],
                    'id_prodi' => $matchingProdi->id,
                    'id_user' => $user_dosen->id,
                ]);
            }
        }
    }
}
