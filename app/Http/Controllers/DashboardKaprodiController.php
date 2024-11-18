<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\Kaprodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardKaprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data Kaprodi berdasarkan id_user yang sedang login
        $kaprodi = Kaprodi::where('id_user', Auth::user()->id)->first();

        // Jika data Kaprodi tidak ditemukan
        if (!$kaprodi) {
            return redirect()->back()->with('error', 'Data Kaprodi tidak ditemukan');
        }

        // Mengambil data Dosen berdasarkan id_prodi Kaprodi
        $dosenIds = Dosen::where('id_prodi', $kaprodi->id_prodi)->pluck('id');

        // Mengambil data Dosen Pembimbing berdasarkan id_dosen yang sesuai
        $dospem_by_prodi = DosenPembimbing::whereIn('id_dosen', $dosenIds)->count();

        $data = [
            'dospem_by_prodi_count' => $dospem_by_prodi,
        ];

        return view('dashboard.kaprodi', $data);
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
