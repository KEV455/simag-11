<?php

namespace App\Http\Controllers;

use App\Models\DosenPembimbing;
use App\Models\Mahasiswa;
use App\Models\PermohonanDosenPembimbing;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PermohonanDosenPembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        // Ambil permohonan dosen pembimbing berdasarkan kondisi
        $permohonan_dosen_pembimbing = PermohonanDosenPembimbing::where('id_mahasiswa', $mahasiswa->id)
            ->where('id_semester', $tahun_ajaran_aktif->id_semester)
            ->get();

        // Cek apakah ada status 'disetujui' atau 'menunggu'
        $tombolAjukanDitampilkan = !$permohonan_dosen_pembimbing->contains(function ($permohonan) {
            return in_array($permohonan->status, ['disetujui', 'menunggu']);
        });

        $data = [
            'permohonan_dosen_pembimbing' => $permohonan_dosen_pembimbing,
            'tombolAjukanDitampilkan' => $tombolAjukanDitampilkan,
        ];

        return view('pages.mahasiswa.permohonan-dosen-pembimbing.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user =  User::where('id', Auth::user()->id)->first();
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $permohonan_dospem_waiting = PermohonanDosenPembimbing::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id_mahasiswa', $mahasiswa->id)->where('status', 'menunggu')->first();

        if ($permohonan_dospem_waiting) {
            Alert::error('Invalid', 'Maaf, Anda tidak dapat mengajukan lebih dari satu permohonan dospem');
            return redirect()->route('mahasiswa.permohonan.dosen.pembimbing.index');
        }

        $permohonan_dospem_active = PermohonanDosenPembimbing::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id_mahasiswa', $mahasiswa->id)->where('status', 'disetujui')->first();

        if ($permohonan_dospem_active) {
            Alert::error('Invalid', 'Maaf, Anda tidak diperboleh untuk mengajukan dospem baru');
            return redirect()->route('mahasiswa.permohonan.dosen.pembimbing.index');
        }

        $data = [
            'dosen_pembimbing' => DosenPembimbing::where('status', 'aktif')->get()
        ];

        return view('pages.mahasiswa.permohonan-dosen-pembimbing.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $user =  User::where('id', Auth::user()->id)->first();
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        PermohonanDosenPembimbing::create([
            'id_mahasiswa' => $mahasiswa->id,
            'id_dosen_pembimbing' => $id,
            'id_semester' => $tahun_ajaran_aktif->id_semester,
            'status' => 'menunggu',
        ]);

        Alert::success('Success', 'Permohonan Dosen Pembimbing berhasil diajukan!');

        return redirect()->route('mahasiswa.permohonan.dosen.pembimbing.index');
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
        $permohonan_dosen_pembimbing = PermohonanDosenPembimbing::findOrFail($id);
        $permohonan_dosen_pembimbing->delete();

        Alert::success('Success', 'Permohonan Dosen Pembimbing Berhasil Dihapus');

        return redirect()->route('mahasiswa.permohonan.dosen.pembimbing.index');
    }
}
