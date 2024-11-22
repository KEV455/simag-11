<?php

namespace App\Http\Controllers;

use App\Models\PelamarMagang;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LamaranMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pelamar_magang_menunggu' => PelamarMagang::where('status_diterima', 'Menunggu')->get()
        ];

        return view('pages.koordinator.pelamar-magang.index', $data);
    }

    public function pelamar_magang_disetujui()
    {
        $data = [
            'pelamar_magang_menunggu' => PelamarMagang::where('status_diterima', 'Diterima')->get()
        ];

        return view('pages.koordinator.pelamar-magang.pelamar-magang-disetujui', $data);
    }

    public function pelamar_magang_ditolak()
    {
        $data = [
            'pelamar_magang_menunggu' => PelamarMagang::where('status_diterima', 'Ditolak')->get()
        ];

        return view('pages.koordinator.pelamar-magang.pelamar-magang-ditolak', $data);
    }

    public function diterima(string $id)
    {
        $pelamar_magang = PelamarMagang::findOrFail($id);

        // Hitung jumlah pelamar magang pada lowongan terkait
        $pelamar_magang_count = PelamarMagang::where('id_lowongan', $pelamar_magang->id_lowongan)->count();

        // Ambil data jumlah kuota lowongan
        $lowongan = $pelamar_magang->lowongan;

        if ($lowongan->jumlah_lowongan <= $pelamar_magang_count) {
            // Jika jumlah pelamar sudah mencapai kuota, tampilkan pesan error
            Alert::error('Info', 'Jumlah Peserta Magang Sudah Penuh pada Lowongan Terkait');
            return redirect()->route('koordinator.pelamar.magang.index');
        }

        // Update status diterima pada pelamar magang
        $pelamar_magang->update(['status_diterima' => 'Diterima']);

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