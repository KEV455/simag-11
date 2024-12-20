<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MitraMandiri;
use App\Models\PelamarMagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user =  User::where('id', Auth::user()->id)->first();
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();

        // mengambil data pelamar magang yang disetujui dan peserta memiliki data peserta magang
        $pelamar_magang = PelamarMagang::where('id_mahasiswa', $mahasiswa->id)->where('status_diterima', 'Diterima')->first();

        $data = [
            'mitras_mandiri_count' => MitraMandiri::where('id_mahasiswa', $mahasiswa->id)->count(),
            'pelamar_magang_count' => PelamarMagang::where('id_mahasiswa', $mahasiswa->id)->count(),
            'pelamar_magang' => $pelamar_magang,
        ];

        return view('dashboard.mahasiswa', $data);
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
