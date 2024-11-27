<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\PembimbingMagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaBimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data user yang sedang login
        $user = User::findOrFail(Auth::id());

        // Ambil data dosen berdasarkan user ID
        $dosen = Dosen::where('id_user', $user->id)->firstOrFail();

        // Ambil data dosen pembimbing berdasarkan dosen ID
        $dosen_pembimbing = DosenPembimbing::where('id_dosen', $dosen->id)->first();

        $pembimbing_magang = PembimbingMagang::with(['mahasiswa.pelamar_magang' => function ($query) {
            $query->where('status_diterima', 'Diterima');
        }, 'mahasiswa.pelamar_magang.peserta_magang.laporan_akhir_magang'])->where('id_dosen_pembimbing', $dosen_pembimbing->id)->get();

        $data = [
            'dosen' => $dosen,
            'dosen_pembimbing' => $dosen_pembimbing,
            'pembimbing_magang' => $pembimbing_magang,
            // 'lowongan_diterima' => $lowongan_diterima,
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
        return view('pages.dospem.mahasiswabimbingan.show');
    }
}
