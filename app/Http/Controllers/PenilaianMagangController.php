<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\LaporanAkhirMagang;
use App\Models\NilaiMagang;
use App\Models\PelamarMagang;
use App\Models\PembimbingMagang;
use App\Models\PesertaMagang;
use App\Models\TranskripNilaiDPL;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PenilaianMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get data user aktif
        $user =  User::where('id', Auth::user()->id)->first();

        // mengambil data dosen
        $dosen = Dosen::where('id_user', $user->id)->first();

        // mengambil data dosen pembimbing
        $dospem = DosenPembimbing::where('id_dosen', $dosen->id)->first();

        $data = [
            'dosen_pembimbing' => $dospem,
            'pembimbing_magangs' => PembimbingMagang::where('id_dosen_pembimbing', $dospem->id)->get()
        ];

        return view('pages.dospem.penilaian-magang.index', $data);
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
    public function store(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nilai_angka' => 'required|numeric|min:0|max:100',
            'nilai_huruf' => 'required|in:A,AB,B,BC,C,D,E',
        ]);

        // Cari data pembimbing magang berdasarkan ID
        $pembimbing_magang = PembimbingMagang::findOrFail($id);
        $pelamar_magang = PelamarMagang::where('id_mahasiswa', $pembimbing_magang->id_mahasiswa)->first();
        $peserta_magang = PesertaMagang::where('id_pelamar_magang', $pelamar_magang->id)->first();

        // Cek apakah data nilai sudah ada untuk mahasiswa ini
        $nilai_magang = NilaiMagang::where('id_peserta_magang', $peserta_magang->id)->first();

        if ($nilai_magang) {
            // Jika data sudah ada, update
            $nilai_magang->update([
                'nilai_angka' => $request->nilai_angka,
                'nilai_huruf' => $request->nilai_huruf,
            ]);

            Alert::success('Success', 'Nilai berhasil diperbarui');
            return redirect()->back();
        } else {
            // mengambil data laporan dan juga transkrip nilai dpl
            $laporan_akhir_magang = LaporanAkhirMagang::where('id_peserta_magang', $peserta_magang->id)->first();
            $transkrip_nilai_dpl = TranskripNilaiDPL::where('id_peserta_magang', $peserta_magang->id)->first();

            // Jika data belum ada, buat data baru
            NilaiMagang::create([
                'validasi' => 'Belum Divalidasi',
                'nilai_angka' => $request->nilai_angka,
                'nilai_huruf' => $request->nilai_huruf,
                'id_peserta_magang' => $peserta_magang->id,
                'id_laporan_akhir_magang' => $laporan_akhir_magang->id,
                'id_transkrip_nilai_dpl' => $transkrip_nilai_dpl->id,
            ]);

            Alert::success('Success', 'Nilai berhasil ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get data user aktif
        $user =  User::where('id', Auth::user()->id)->first();

        // mengambil data dosen
        $dosen = Dosen::where('id_user', $user->id)->first();

        // mengambil data dosen pembimbing
        $dospem = DosenPembimbing::where('id_dosen', $dosen->id)->first();

        $pembimbing_magangs = PembimbingMagang::where('id_dosen_pembimbing', $dospem->id)->pluck('id')->toArray();

        // Validasi: cek apakah ID ada di $pembimbing_magangs
        if (!in_array($id, $pembimbing_magangs)) {
            Alert::info('Oops', 'Mahasiswa Bimbingan Invalid');
            return redirect()->back();
        }

        $pembimbing_magang = PembimbingMagang::findOrFail($id);
        $pelamar_magang = PelamarMagang::where('id_mahasiswa', $pembimbing_magang->id_mahasiswa)->first();

        if (is_null($pelamar_magang)) {
            Alert::info('Oops', 'Mahasiswa belum melakukan pendaftaran magang');
            return redirect()->back();
        }

        $peserta_magang = PesertaMagang::where('id_pelamar_magang', $pelamar_magang->id)->first();

        if (is_null($peserta_magang)) {
            Alert::info('Oops', 'Mahasiswa belum aktif dalam kegiatan magang');
            return redirect()->back();
        }

        // Mengambil nilai magang jika ada
        $nilai = NilaiMagang::where('id_peserta_magang', $peserta_magang->id)->first();

        $data = [
            'pembimbing_magang' => $pembimbing_magang,
            'laporan_akhir' => LaporanAkhirMagang::where('id_peserta_magang', $peserta_magang->id)->first(),
            'transkrip_nilai_dpl' => TranskripNilaiDPL::where('id_peserta_magang', $peserta_magang->id)->first(),
            'nilai' => $nilai,
        ];

        return view('pages.dospem.penilaian-magang.show', $data);
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
