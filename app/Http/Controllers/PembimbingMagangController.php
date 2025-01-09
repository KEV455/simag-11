<?php

namespace App\Http\Controllers;

use App\Models\DosenPembimbing;
use App\Models\Mahasiswa;
use App\Models\PembimbingMagang;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PembimbingMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $data = [
            'dosen_pembimbing' => DosenPembimbing::findOrFail($id),
            'pembimbing_magang' => PembimbingMagang::where('id_dosen_pembimbing', $id)->where('id_semester', $tahun_ajaran_aktif->id_semester)->get()
        ];

        return view('pages.kaprodi.pembimbing-magang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $data = [
            'dosen_pembimbing' => DosenPembimbing::findOrFail($id),
            'pembimbing_magang' => PembimbingMagang::where('id_dosen_pembimbing', $id)->where('id_semester', $tahun_ajaran_aktif->id_semester)->get(),
            'mahasiswa' => Mahasiswa::whereNotIn('id', function ($query) use ($tahun_ajaran_aktif) {
                $query->select('id_mahasiswa')
                    ->from('pembimbing_magangs')
                    ->where('id_semester', $tahun_ajaran_aktif->id_semester);
            })->get(),
        ];

        return view('pages.kaprodi.pembimbing-magang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'mahasiswas' => ['required', 'array', 'min:1'],
        ]);

        $dospem = DosenPembimbing::findOrFail($id);
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();
        $mahasiswa_convert = collect($validated['mahasiswas']);
        $check_id_mahasiswa = $mahasiswa_convert->except('_token');

        if ($check_id_mahasiswa) {
            foreach ($check_id_mahasiswa as $mahasiswaId) {
                $pembimbing_magang_dospem_count = PembimbingMagang::where('id_dosen_pembimbing', $id)->where('id_semester', $tahun_ajaran_aktif->id_semester)->count();

                // pengecekan kuota dospem
                if ($pembimbing_magang_dospem_count < $dospem->kuota) {
                    PembimbingMagang::create([
                        'id_dosen_pembimbing' => $id,
                        'id_mahasiswa' => $mahasiswaId,
                        'id_semester' => $tahun_ajaran_aktif->id_semester,
                    ]);
                }
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
