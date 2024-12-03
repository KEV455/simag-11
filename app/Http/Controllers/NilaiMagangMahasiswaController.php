<?php

namespace App\Http\Controllers;

use App\Models\LaporanAkhirMagang;
use App\Models\Mahasiswa;
use App\Models\NilaiMagang;
use App\Models\PelamarMagang;
use App\Models\PembimbingMagang;
use App\Models\PesertaMagang;
use App\Models\TranskripNilaiDPL;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiMagangMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Ambil data user yang sedang login
            $user = User::findOrFail(Auth::id());

            // Ambil data mahasiswa berdasarkan user ID
            $mahasiswa = Mahasiswa::where('id_user', $user->id)->firstOrFail();

            // Ambil data pelamar magang dengan status 'Diterima'
            $pelamarMagang = PelamarMagang::where('id_mahasiswa', $mahasiswa->id)
                ->where('status_diterima', 'Diterima')
                ->firstOrFail();

            // Ambil data peserta magang berdasarkan pelamar magang
            $pesertaMagang = PesertaMagang::where('id_pelamar_magang', $pelamarMagang->id)
                ->firstOrFail();

            // Ambil data nilai magang yang sudah disetujui
            $nilaiMagang = NilaiMagang::where('id_peserta_magang', $pesertaMagang->id)
                ->where('validasi', 'Setuju') // Pastikan kolom status ada dan sesuai
                ->get();
            $pembimbingMagang = PembimbingMagang::where('id_mahasiswa', $mahasiswa->id)->first();

            $data = [
                'pembimbingMagang' => $pembimbingMagang,
                'pelamarMagang' => $pelamarMagang,
                'pesertaMagang' => $pesertaMagang,
                'nilaiMagang' => $nilaiMagang,
                'laporan_akhir' => LaporanAkhirMagang::where('id_peserta_magang', $pesertaMagang->id)->first(),
                'transkrip_nilai_dpl' => TranskripNilaiDPL::where('id_peserta_magang', $pesertaMagang->id)->first(),
            ];

            // Return data nilai magang ke view
            return view('pages.mahasiswa.nilai-mahasiswa.index', $data);
        } catch (\Exception $e) {
            // Tangani error jika data tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan atau belum lengkap.');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
