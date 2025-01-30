<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\PembimbingMagang;
use App\Models\PermohonanDosenPembimbing;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PermohonanDosenController extends Controller
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

        // Ambil tahun ajaran yang sedang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $data = [
            'dospem' => $dospem,
            'permohonan_dosen_pembimbing' => PermohonanDosenPembimbing::where('status', 'menunggu')->where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id_dosen_pembimbing', $dospem->id)->get()
        ];

        return view('pages.dospem.permohonan-pembimbing.index', $data);
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

    public function disetujui(string $id)
    {
        // Ambil data permohonan dosen pembimbing berdasarkan ID
        $permohonan_dosen_pembimbing = PermohonanDosenPembimbing::findOrFail($id);

        // Ambil data dosen pembimbing
        $dosenPembimbing = DosenPembimbing::findOrFail($permohonan_dosen_pembimbing->id_dosen_pembimbing);

        // Ambil total kuota pembimbing dari dosen pembimbing
        $kuota = $dosenPembimbing->kuota;

        // Ambil tahun ajaran aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        if (!$tahun_ajaran_aktif) {
            Alert::error('Error', 'Tahun ajaran aktif tidak ditemukan.');
            return redirect()->back();
        }

        // Hitung jumlah mahasiswa yang sudah dibimbing oleh dosen ini
        $jumlahMahasiswaDibimbing = PembimbingMagang::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id_dosen_pembimbing', $dosenPembimbing->id)->count();

        // Cek apakah kuota sudah terpenuhi`
        if ($jumlahMahasiswaDibimbing >= $kuota) {
            // Jika kuota terpenuhi, update status permohonan menjadi "ditolak"
            $permohonan_dosen_pembimbing->update([
                'status' => 'ditolak',
            ]);

            Alert::error('Gagal', 'Kuota dosen pembimbing telah penuh. Permohonan ditolak.');
        } else {
            // Jika kuota belum terpenuhi, tambahkan data ke tabel PembimbingMagang
            PembimbingMagang::create([
                'id_dosen_pembimbing' => $permohonan_dosen_pembimbing->id_dosen_pembimbing,
                'id_mahasiswa' => $permohonan_dosen_pembimbing->id_mahasiswa,
                'id_semester' => $tahun_ajaran_aktif->id_semester,
            ]);

            // Update status permohonan menjadi "disetujui"
            $permohonan_dosen_pembimbing->update([
                'status' => 'disetujui',
            ]);

            Alert::success('Success', 'Permohonan Dosen Pembimbing Berhasil Disetujui.');
        }

        return redirect()->back();
    }



    public function ditolak(string $id)
    {
        $permohonan_dosen_pembimbing = PermohonanDosenPembimbing::findOrFail($id);

        $updateData = [
            'status' => 'Ditolak',
        ];

        // Update data mitra
        $permohonan_dosen_pembimbing->update($updateData);

        Alert::success('Success', 'Permohonan Dosen Pembimbing Berhasil Ditolak');

        return redirect()->back();
    }

    public function permohonan_dosen_disetujui()
    {
        // get data user aktif
        $user =  User::where('id', Auth::user()->id)->first();

        // mengambil data dosen
        $dosen = Dosen::where('id_user', $user->id)->first();

        // mengambil data dosen pembimbing
        $dospem = DosenPembimbing::where('id_dosen', $dosen->id)->first();

        // Ambil tahun ajaran yang sedang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $data = [
            'dospem' => $dospem,
            'permohonan_dosen_pembimbing' => PermohonanDosenPembimbing::where('status', 'disetujui')->where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id_dosen_pembimbing', $dospem->id)->get()
        ];

        return view('pages.dospem.permohonan-pembimbing.permohonan-disetujui', $data);
    }

    public function permohonan_dosen_ditolak()
    {
        // get data user aktif
        $user =  User::where('id', Auth::user()->id)->first();

        // mengambil data dosen
        $dosen = Dosen::where('id_user', $user->id)->first();

        // mengambil data dosen pembimbing
        $dospem = DosenPembimbing::where('id_dosen', $dosen->id)->first();

        // Ambil tahun ajaran yang sedang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $data = [
            'dospem' => $dospem,
            'permohonan_dosen_pembimbing' => PermohonanDosenPembimbing::where('status', 'ditolak')->where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id_dosen_pembimbing', $dospem->id)->get()
        ];
        return view('pages.dospem.permohonan-pembimbing.permohonan-ditolak', $data);
    }
}
