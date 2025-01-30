<?php

namespace App\Http\Controllers;

use App\Models\BerkasLowongan;
use App\Models\KategoriBidang;
use App\Models\Lowongan;
use App\Models\LowonganProdi;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DaftarMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data tahun ajaran yang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        // Ambil data kategori bidang untuk dropdown
        $kategori_bidangs = KategoriBidang::all();

        // Cek apakah filter diterapkan
        $id_kategori_bidang = $request->input('id_kategori_bidang');

        if ($id_kategori_bidang) {
            // Query dengan filter id_kategori_bidang dan muat relasi lowongan_prodi
            $lowongan_by_kategori = Lowongan::with('lowongan_prodi')
                ->withCount([
                    'pelamar_magang as pelamar_diterima_count' => function ($query) {
                        $query->whereColumn('pelamar_magangs.id_lowongan', 'lowongans.id')
                            ->where('status_diterima', 'Diterima');
                    }
                ])
                ->where('status', 'Aktif')->where('id_semester', $tahun_ajaran_aktif->id_semester)
                ->whereHas('mitra', function ($query) use ($id_kategori_bidang) {
                    $query->where('id_kategori_bidang', $id_kategori_bidang);
                })
                ->get();
        } else {
            // Jika tidak ada filter, tampilkan semua data dengan relasi lowongan_prodi
            $lowongan_by_kategori = Lowongan::with('lowongan_prodi')
                ->withCount([
                    'pelamar_magang as pelamar_diterima_count' => function ($query) {
                        $query->whereColumn('pelamar_magangs.id_lowongan', 'lowongans.id')
                            ->where('status_diterima', 'Diterima');
                    }
                ])
                ->where('status', 'Aktif')->where('id_semester', $tahun_ajaran_aktif->id_semester)
                ->get();
        }

        // dd($lowongan_by_kategori);

        // Kirim data ke view
        return view('pages.mahasiswa.pendaftaran-magang.index', [
            'kategori_bidangs' => $kategori_bidangs,
            'lowongan_by_kategori' => $lowongan_by_kategori,
        ]);
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
        // Ambil data tahun ajaran yang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $lowongan = Lowongan::findOrFail($id);

        if ($lowongan->id_semester !== $tahun_ajaran_aktif->id_semester) {
            Alert::error('Invalid', 'Maaf, Lowongan Tidak Tersedia');
            return redirect()->back();
        }

        $user =  User::where('id', Auth::user()->id)->first();
        $lowonganProdi = LowonganProdi::where('id_lowongan', $id)->get();

        // Ambil data mahasiswa berdasarkan user
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->firstOrFail();

        // Ambil data lowongan prodi terkait lowongan ini
        $lowonganProdi = LowonganProdi::where('id_lowongan', $id)
            ->pluck('id_prodi') // Hanya ambil kolom id_prodi
            ->toArray();

        // Cek apakah id_prodi mahasiswa ada di data lowongan prodi
        $prodiMhsAvailable = in_array($mahasiswa->id_prodi, $lowonganProdi);

        if ($lowongan->status == 'Tidak Aktif') {
            Alert::error('Invalid', 'Maaf, Lowongan Tidak Tersedia');
            return redirect()->route('mahasiswa.daftar.magang.index');
        }

        $data = [
            'lowongan' => $lowongan,
            'lowongan_prodis' => LowonganProdi::where('id_lowongan', $id)->get(),
            'berkas_lowongans' => BerkasLowongan::where('id_lowongan', $id)->get(),
            'prodiMhsAvailable' => $prodiMhsAvailable,
        ];

        return view('pages.mahasiswa.pendaftaran-magang.show', $data);
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
