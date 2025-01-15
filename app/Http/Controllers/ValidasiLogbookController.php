<?php

namespace App\Http\Controllers;

use App\Models\DPLLowongan;
use App\Models\DPLMitra;
use App\Models\Logbook;
use App\Models\Lowongan;
use App\Models\PelamarMagang;
use App\Models\PesertaMagang;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ValidasiLogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $user =  User::where('id', Auth::user()->id)->first();
        $dpl_mitra = DPLMitra::where('email', $user->email)->first();

        $data = [
            'dpl_lowongans' => DPLLowongan::where('id_dpl_mitra', $dpl_mitra->id)
                ->whereHas('lowongan', function ($query) use ($tahun_ajaran_aktif) {
                    $query->where('id_semester', $tahun_ajaran_aktif->id_semester);
                })
                ->get(),
        ];

        return view('pages.dpl.validasi-logbook.index', $data);
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
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $lowongan = Lowongan::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id', $id)->first();

        if (!$lowongan) {
            Alert::error('Invalid', 'Maaf, Lowongan Tidak Valid');
            return redirect()->route('dpl.validasi.logbook.index');
        }

        $user = User::where('id', Auth::user()->id)->first();
        $dpl_mitra = DPLMitra::where('email', $user->email)->first();

        $lowonganDPL = DPLLowongan::where('id_lowongan', $lowongan->id)
            ->where('id_dpl_mitra', $dpl_mitra->id)
            ->first();

        if (!$lowonganDPL) {
            Alert::error('Invalid', 'Maaf, Lowongan Tidak Valid');
            return redirect()->route('dpl.validasi.logbook.index');
        }

        $pelamar_magangs = PelamarMagang::where('status_diterima', 'Diterima')
            ->where('id_lowongan', $lowongan->id)
            ->with('peserta_magang')
            ->get();

        $data = [
            'lowongan' => $lowongan,
            'pelamar_magangs' => $pelamar_magangs
        ];

        return view('pages.dpl.validasi-logbook.show', $data);
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

    public function showLogbook($id)
    {
        $peserta_magang = PesertaMagang::findOrFail($id);

        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $lowongan = Lowongan::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id', $peserta_magang->pelamar_magang->id_lowongan)->first();

        if (!$lowongan) {
            Alert::error('Invalid', 'Maaf, Lowongan Tidak Valid');
            return redirect()->route('dpl.validasi.logbook.index');
        }

        $user = User::where('id', Auth::user()->id)->first();
        $dpl_mitra = DPLMitra::where('email', $user->email)->first();

        $lowonganDPL = DPLLowongan::where('id_lowongan', $lowongan->id)
            ->where('id_dpl_mitra', $dpl_mitra->id)
            ->first();

        if (!$lowonganDPL) {
            Alert::error('Invalid', 'Maaf, Lowongan Tidak Valid');
            return redirect()->route('dpl.validasi.logbook.index');
        }

        $data = [
            'peserta_magang' => $peserta_magang,
            'pelamar_magang' => PelamarMagang::where('id', $peserta_magang->id_pelamar_magang)->first(),
            'logbook' =>  Logbook::where('id_peserta_magang', $id)->where('validasi', false)->get(),
            'lowongan' => Lowongan::where('id', $peserta_magang->id_lowongan)->first(),
        ];
        return view('pages.dpl.validasi-logbook.validasi', $data);
    }

    public function diterima(string $id)
    {
        $logbook = Logbook::findOrFail($id);

        $updateData = [
            'validasi' => true,
        ];

        // Update data mitra
        $logbook->update($updateData);

        Alert::success('Success', 'Logbook Berhasil Disetujui');

        return redirect()->back();
    }
}
