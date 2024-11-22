<?php

namespace App\Http\Controllers;

use App\Models\BerkasLowongan;
use App\Models\BerkasPelamar;
use App\Models\Lowongan;
use App\Models\Mahasiswa;
use App\Models\PelamarMagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PelamarMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = [
            'lowongan' => Lowongan::findOrFail($id),
            'berkas_lowongan' => BerkasLowongan::where('id_lowongan', $id)->get()
        ];

        return view('pages.mahasiswa.pelamar-magang.index', $data);
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
    public function store(Request $request, $id)
    {
        $lowongan = Lowongan::findOrFail($id); // Cari data lowongan
        $user = Auth::user(); // Ambil data user yang sedang login
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->firstOrFail(); // Ambil data mahasiswa berdasarkan user

        // Validasi file
        $request->validate([
            'file.*' => ['required', 'mimes:pdf', 'max:5120'], // File harus .pdf dan max 5MB
        ]);

        // Buat data pelamar magang
        $pelamarMagang = PelamarMagang::create([
            'status_diterima' => 'Menunggu', // Default status
            'id_mahasiswa' => $mahasiswa->id,
            'id_lowongan' => $lowongan->id,
        ]);

        // Upload dan simpan data file ke `BerkasPelamar`
        foreach ($request->file('file') as $index => $file) {
            $berkasLowongan = BerkasLowongan::where('id_lowongan', $lowongan->id)->skip($index)->first();

            if ($berkasLowongan) {
                $path = $file->store('berkas_pelamar', 'public'); // Simpan file di folder `storage/app/public/berkas_pelamar`

                BerkasPelamar::create([
                    'file' => $path, // Path file
                    'id_pelamar_magang' => $pelamarMagang->id,
                    'id_berkas_lowongan' => $berkasLowongan->id,
                ]);
            }
        }

        Alert::success('Success', 'Lamaran berhasil diajukan!');

        return redirect()->route('mahasiswa.daftar.magang.index');
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
