<?php

namespace App\Http\Controllers;

use App\Models\PelamarMagang;
use App\Models\PesertaMagang;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LamaranMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil tahun ajaran yang sedang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $data = [
            'pelamar_magang_menunggu' => PelamarMagang::where('status_diterima', 'Menunggu')->where('id_semester', $tahun_ajaran_aktif->id_semester)->get()
        ];

        return view('pages.koordinator.pelamar-magang.index', $data);
    }

    public function pelamar_magang_disetujui()
    {
        // Ambil tahun ajaran yang sedang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $data = [
            'pelamar_magang_menunggu' => PelamarMagang::where('status_diterima', 'Diterima')->where('id_semester', $tahun_ajaran_aktif->id_semester)->get()
        ];

        return view('pages.koordinator.pelamar-magang.pelamar-magang-disetujui', $data);
    }

    public function pelamar_magang_ditolak()
    {
        // Ambil tahun ajaran yang sedang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $data = [
            'pelamar_magang_menunggu' => PelamarMagang::where('status_diterima', 'Ditolak')->where('id_semester', $tahun_ajaran_aktif->id_semester)->get()
        ];

        return view('pages.koordinator.pelamar-magang.pelamar-magang-ditolak', $data);
    }

    public function diterima(string $id)
    {
        // Ambil tahun ajaran yang sedang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $pelamar_magang = PelamarMagang::findOrFail($id);

        // Hitung jumlah pelamar magang pada lowongan terkait
        $pelamar_magang_count = PelamarMagang::where('id_lowongan', $pelamar_magang->id_lowongan)->where('status_diterima', 'Diterima')->count();

        // Ambil data jumlah kuota lowongan
        $lowongan = $pelamar_magang->lowongan;

        if ($lowongan->jumlah_lowongan <= $pelamar_magang_count) {
            // Jika jumlah pelamar sudah mencapai kuota, tampilkan pesan error
            Alert::error('Info', 'Jumlah Peserta Magang Sudah Penuh pada Lowongan Terkait');
            return redirect()->route('koordinator.pelamar.magang.index');
        }

        // Update status diterima pada pelamar magang
        $pelamar_magang->update(['status_diterima' => 'Diterima']);

        // mengambil semua pelamar magang milik mahasiswa
        $pelamar_magang_mhs = PelamarMagang::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id_mahasiswa', $pelamar_magang->id_mahasiswa)->where('status_diterima', 'Menunggu')->get();

        // update seluruh data pelamar magang mhs selain yang di izinkan agar otomatis tertolak
        foreach ($pelamar_magang_mhs as $pm_mhs) {
            if ($pm_mhs->id != $pelamar_magang->id) {
                $pm_mhs->update(['status_diterima' => 'Ditolak']);
            }
        }

        // Buat data peserta magang
        $peserta_magang = new PesertaMagang();
        $peserta_magang->id_pelamar_magang = $pelamar_magang->id;
        $peserta_magang->tanggal_disetujui = now(); // Set tanggal sekarang
        $peserta_magang->save();

        // Tampilkan pesan sukses
        Alert::success('Success', 'Pelamar Magang Berhasil Disetujui');
        return redirect()->route('koordinator.pelamar.magang.index');
    }

    public function ditolak(string $id)
    {
        $pelamar_magang = PelamarMagang::findOrFail($id);

        $updateData = [
            'status_diterima' => 'Ditolak',
        ];

        // Update data
        $pelamar_magang->update($updateData);

        Alert::success('Success', 'Pelamar Magang Berhasil Ditolak');

        return redirect()->route('koordinator.pelamar.magang.index');
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
