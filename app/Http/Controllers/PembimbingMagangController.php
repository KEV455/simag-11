<?php

namespace App\Http\Controllers;

use App\Models\DosenPembimbing;
use App\Models\Mahasiswa;
use App\Models\PembimbingMagang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PembimbingMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = [
            'dosen_pembimbing' => DosenPembimbing::findOrFail($id),
            'pembimbing_magang' => PembimbingMagang::where('id_dosen_pembimbing', $id)->get()

        ];

        return view('pages.kaprodi.pembimbingmagang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $data = [
            'dosen_pembimbing' => DosenPembimbing::findOrFail($id),
            'pembimbing_magang' => PembimbingMagang::where('id_dosen_pembimbing', $id)->get(),
            'mahasiswa' => Mahasiswa::whereNotIn('id', PembimbingMagang::pluck('id_mahasiswa'))->get(),

        ];
        return view('pages.kaprodi.pembimbingmagang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'mahasiswas' => ['required', 'array', 'min:1'],
        ]);

        $mahasiswa_convert = collect($validated['mahasiswas']);
        $check_id_mahasiswa = $mahasiswa_convert->except('_token');

        if ($check_id_mahasiswa) {
            foreach ($check_id_mahasiswa as $mahasiswaId) {
                PembimbingMagang::create([
                    'id_dosen_pembimbing' => $id,
                    'id_mahasiswa' => $mahasiswaId,
                ]);
            }
        }

        Alert::success('Success', 'Data Mahasiswa Berhasil Ditambahkan');

        return redirect()->route('kaprodi.pembimbing.magang.index', $id);
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
        $pembimbing_magang = PembimbingMagang::findOrFail($id);
        $id_pembimbing_magang = $pembimbing_magang->id_dosen_pembimbing;
        $pembimbing_magang->delete();

        Alert::success('Success', 'Data Mahasiswa Berhasil Dihapus');

        return redirect()->route('kaprodi.pembimbing.magang.index', $id_pembimbing_magang);
    }
}
