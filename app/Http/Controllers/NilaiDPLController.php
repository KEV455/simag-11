<?php

namespace App\Http\Controllers;

use App\Models\DPLLowongan;
use App\Models\DPLMitra;
use App\Models\KriteriaPenilaianMitra;
use App\Models\Lowongan;
use App\Models\NilaiDPL;
use App\Models\PelamarMagang;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class NilaiDPLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $user =  User::where('id', Auth::user()->id)->first();
        $dpl_mitra = DPLMitra::where('email', $user->email)->first();

        $data = [
            'dpl_lowongans' => DPLLowongan::where('id_dpl_mitra', $dpl_mitra->id)
                ->whereHas('lowongan', function ($query) use ($tahun_ajaran_aktif) {
                    $query->where('id_semester', $tahun_ajaran_aktif->id_semester);
                })
                ->get(),
        ];

        return view('pages.dpl.nilai-dpl.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $pelamar_magang = PelamarMagang::findOrFail($id);

        $lowongan = Lowongan::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id', $pelamar_magang->id_lowongan)->first();

        if (!$lowongan) {
            Alert::error('Invalid', 'Maaf, Lowongan Tidak Valid');
            return redirect()->route('dpl.nilai.dpl.index');
        }

        $user =  User::where('id', Auth::user()->id)->first();
        $dpl_mitra = DPLMitra::where('email', $user->email)->first();
        $lowonganDPL = DPLLowongan::where('id_lowongan', $pelamar_magang->id_lowongan)->where('id_dpl_mitra', $dpl_mitra->id)->first();

        if (!$lowonganDPL) {
            Alert::error('Invalid', 'Maaf, Lowongan Tidak Valid');
            return redirect()->route('dpl.nilai.dpl.index');
        }

        // mengambil kriteria penilaian mitra
        $kriteria_penilaian_mitras = KriteriaPenilaianMitra::where('id_mitra', $pelamar_magang->lowongan->id_mitra)->get();

        // Mengambil nilai DPL dengan kondisi id_kriteria_penilaian
        $nilai_dpls = NilaiDPL::where('id_mahasiswa', $pelamar_magang->id_mahasiswa)
            ->whereIn('id_kriteria_penilaian', $kriteria_penilaian_mitras->pluck('id_kriteria_penilaian'))
            ->get();

        // Menghitung jumlah dan rata-rata nilai DPL
        $jumlah_nilai = $nilai_dpls->sum('nilai');
        $rata_rata_nilai = $nilai_dpls->count() > 0 ? $jumlah_nilai / $nilai_dpls->count() : 0;

        $data = [
            'pelamar_magang' => $pelamar_magang,
            'kriteria_penilaian_mitras' => $kriteria_penilaian_mitras,
            'nilai_dpls' => $nilai_dpls,
            'jumlah_nilai' => $jumlah_nilai,
            'rata_rata_nilai' => round($rata_rata_nilai, 1),
        ];

        return view('pages.dpl.nilai-dpl.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'nilai.*' => 'required|numeric|min:0|max:100',
            'id_kriteria_penilaian.*' => 'required|exists:kriteria_penilaians,id',
        ]);

        $user =  User::where('id', Auth::user()->id)->first();
        $dpl_mitra = DPLMitra::where('email', $user->email)->first();

        if (!$dpl_mitra) {
            return redirect()->back()->with('error', 'DPL Mitra tidak valid.');
        }

        $nilai_total = 0;

        foreach ($request->id_kriteria_penilaian as $index => $id_kriteria_penilaian) {
            $nilai = $request->nilai[$index];

            // Create or Update NilaiDPL
            NilaiDPL::updateOrCreate(
                [
                    'id_mahasiswa' => $id,
                    'id_dpl_mitra' => $dpl_mitra->id,
                    'id_kriteria_penilaian' => $id_kriteria_penilaian,
                ],
                [
                    'nilai' => $nilai,
                ]
            );

            $nilai_total += $nilai;
        }

        Alert::success('Success', 'Penilaian DPL Berhasil');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $lowongan = Lowongan::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id', $id)->first();

        if (!$lowongan) {
            Alert::error('Invalid', 'Maaf, Lowongan Tidak Valid');
            return redirect()->route('dpl.nilai.dpl.index');
        }

        $user =  User::where('id', Auth::user()->id)->first();
        $dpl_mitra = DPLMitra::where('email', $user->email)->first();

        $lowonganDPL = DPLLowongan::where('id_lowongan', $lowongan->id)->where('id_dpl_mitra', $dpl_mitra->id)->first();

        if (!$lowonganDPL) {
            Alert::error('Invalid', 'Maaf, Lowongan Tidak Valid');
            return redirect()->route('dpl.nilai.dpl.index');
        }

        $data = [
            'lowongan' => $lowongan,
            'pelamar_magangs' => PelamarMagang::where('status_diterima', 'Diterima')->where('id_lowongan', $lowongan->id)->get()
        ];

        return view('pages.dpl.nilai-dpl.show', $data);
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
