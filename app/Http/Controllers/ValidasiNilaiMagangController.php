<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\Kaprodi;
use App\Models\NilaiMagang;
use App\Models\PelamarMagang;
use App\Models\PembimbingMagang;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ValidasiNilaiMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kaprodi = Kaprodi::where('id_user', Auth::user()->id)->first();

        // Jika data Kaprodi tidak ditemukan
        if (!$kaprodi) {
            return redirect()->back()->with('error', 'Data Kaprodi tidak ditemukan');
        }

        // Mengambil data Dosen berdasarkan id_prodi Kaprodi
        $dosenIds = Dosen::where('id_prodi', $kaprodi->id_prodi)->pluck('id');

        // Mengambil data Dosen Pembimbing berdasarkan id_dosen yang sesuai
        $dospem_by_prodi = DosenPembimbing::whereIn('id_dosen', $dosenIds)->get();

        $data = [
            'dosen_pembimbings' => $dospem_by_prodi,
        ];

        return view('pages.kaprodi.validasi-nilai-magang.index', $data);
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
        // Ambil seluruh data pembimbing magang berdasarkan dosen pembimbing
        $pembimbing_magangs = PembimbingMagang::where('id_dosen_pembimbing', $id)->get();

        // Inisialisasi array untuk menampung nilai magang
        $nilai_magangs = [];

        foreach ($pembimbing_magangs as $pembimbing_magang) {
            // Cari pelamar magang berdasarkan mahasiswa pada pembimbing magang
            $pelamar_magang = PelamarMagang::where('id_mahasiswa', $pembimbing_magang->id_mahasiswa)->first();

            if ($pelamar_magang) {
                // Cari peserta magang berdasarkan pelamar magang
                $peserta_magang = PesertaMagang::where('id_pelamar_magang', $pelamar_magang->id)->first();

                if ($peserta_magang) {
                    // Cari nilai magang berdasarkan peserta magang
                    $nilai_magang = NilaiMagang::where('id_peserta_magang', $peserta_magang->id)->first();

                    if ($nilai_magang) {
                        // Tambahkan nilai magang ke dalam array
                        $nilai_magangs[] = $nilai_magang;
                    }
                }
            }
        }

        // Data untuk dikirim ke view
        $data = [
            'dosen_pembimbing' => DosenPembimbing::find($id),
            'nilai_magangs' => $nilai_magangs,
        ];

        return view('pages.kaprodi.validasi-nilai-magang.show', $data);
    }

    public function validasi($id)
    {
        // Ambil data nilai magang berdasarkan id
        $nilai_magang = NilaiMagang::find($id);

        // Jika data nilai magang ditemukan
        if ($nilai_magang) {
            // Update validasi nilai magang menjadi 'Setuju'
            $nilai_magang->validasi = 'Setuju';
            $nilai_magang->save();

            Alert::success('Success', 'Data nilai magang berhasil divalidasi');
            return redirect()->back();
        }

        Alert::error('Error', 'Data nilai magang tidak ditemukan');
        return redirect()->back();
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
