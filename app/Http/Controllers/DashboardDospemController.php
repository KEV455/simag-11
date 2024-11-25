<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\PembimbingMagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardDospemController extends Controller
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
            'pembimbing_magang_count' => PembimbingMagang::where('id_dosen_pembimbing', $dospem->id)->count()
        ];

        return view('dashboard.dospem', $data);
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
