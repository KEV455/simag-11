<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PelamarMagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanMagangMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->firstOrFail();

        $data = [
            'pelamar_magang' => PelamarMagang::where('id_mahasiswa', $mahasiswa->id)
                ->with('berkas_pelamar') // Load relasi berkas pelamar
                ->get(),
        ];


        return view('pages.mahasiswa.permohonan-magang.index', $data);
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
