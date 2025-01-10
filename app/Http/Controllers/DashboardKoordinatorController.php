<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\KategoriBidang;
use App\Models\Lowongan;
use App\Models\Mitra;
use App\Models\MitraMandiri;
use App\Models\PelamarMagang;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class DashboardKoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil tahun ajaran yang sedang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $data = [
            'kategori_bidang_count' => KategoriBidang::count(),
            'mitra_count' => Mitra::count(),
            'berkas_count' => Berkas::count(),
            'lowongan_count' => Lowongan::count(),
            'mitra_mandiri_count' => MitraMandiri::count(),
            'pelamar_magang_menunggu_count' => PelamarMagang::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('status_diterima', 'Menunggu')->count()
        ];

        return view('dashboard.koordinator', $data);
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
