<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\Logbook;
use App\Models\PembimbingMagang;
use App\Models\PesertaMagang;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaBimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        // Ambil data user yang sedang login
        $user = User::findOrFail(Auth::id());

        // Ambil data dosen berdasarkan user ID
        $dosen = Dosen::where('id_user', $user->id)->firstOrFail();

        // Ambil data dosen pembimbing berdasarkan dosen ID
        $dosen_pembimbing = DosenPembimbing::where('id_dosen', $dosen->id)->first();

        // Ambil data pembimbing magang sesuai dengan tahun ajaran aktif
        $pembimbing_magang = PembimbingMagang::where('id_semester', $tahun_ajaran_aktif->id_semester)
            ->with([
                'mahasiswa.pelamar_magang' => function ($query) use ($tahun_ajaran_aktif) {
                    $query->where('status_diterima', 'Diterima')
                        ->where('id_semester', $tahun_ajaran_aktif->id_semester);
                },
                'mahasiswa.pelamar_magang.peserta_magang.laporan_akhir_magang'
            ])
            ->where('id_dosen_pembimbing', $dosen_pembimbing->id)
            ->get();

        $data = [
            'dosen' => $dosen,
            'dosen_pembimbing' => $dosen_pembimbing,
            'pembimbing_magang' => $pembimbing_magang,
        ];

        return view('pages.dospem.mahasiswabimbingan.index', $data);
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


    public function logbook($id)
    {
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        // Ambil data user yang sedang login
        $user = User::findOrFail(Auth::id());

        // Ambil data dosen berdasarkan user ID
        $dosen = Dosen::where('email', $user->email)->firstOrFail();

        // get data dospem
        $dospem = DosenPembimbing::where('id_dosen', $dosen->id)->first();

        // get data pembimbing magang
        $peserta_magang = PesertaMagang::findOrFail($id);

        $pembimbing_magang = PembimbingMagang::where('id_mahasiswa', $peserta_magang->pelamar_magang->mahasiswa->id)->where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id_dosen_pembimbing', $dospem->id)->first();

        if (!$pembimbing_magang) {
            Alert::error('Invalid', 'Mahasiswa Bimbingan Invalid');
            return redirect()->route('dospem.mahasiswa.bimbingan.index');
        }

        // Ambil logbook berdasarkan peserta magang
        $logbook = Logbook::where('id_peserta_magang', $id)
            ->orderBy('tanggal_kegiatan', 'asc')
            ->get()
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('F Y'); // Kelompokkan berdasarkan Bulan dan Tahun
            });

        // Ambil nama mahasiswa dari relasi
        $pesertaMagang = PesertaMagang::with('pelamar_magang.mahasiswa')
            ->where('id', $id)
            ->first();

        $namaMahasiswa = $pesertaMagang->pelamar_magang->mahasiswa->nama_mahasiswa ?? 'Nama Mahasiswa Tidak Tersedia';

        return view('pages.dospem.mahasiswabimbingan.show', [
            'logbook' => $logbook,
            'namaMahasiswa' => $namaMahasiswa
        ]);
    }
}
