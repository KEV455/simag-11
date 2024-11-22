<?php

namespace App\Http\Controllers;

use App\Models\BerkasPelamar;
use App\Models\Mahasiswa;
use App\Models\PelamarMagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

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
        $pelamar_magang = PelamarMagang::findOrFail($id);
        $berkas_pelamar = BerkasPelamar::where('id_pelamar_magang', $id)->get();

        foreach ($berkas_pelamar as $berkas) {
            if ($berkas->file != null) {

                $filePath = $berkas->file;

                // Periksa apakah file tersebut benar-benar ada di penyimpanan
                if (Storage::disk('public')->exists($filePath)) {
                    // Hapus file terkait dari penyimpanan
                    Storage::disk('public')->delete($filePath);
                }
            }
        }


        $pelamar_magang->delete();

        Alert::success('Success', 'Pelamar Magang Berhasil Dihapus');

        return redirect()->route('mahasiswa.permohonan.magang.index');
    }
}
