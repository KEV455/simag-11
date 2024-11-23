<?php

namespace App\Http\Controllers;

use App\Models\LaporanAkhirMagang;
use App\Models\Mahasiswa;
use App\Models\PelamarMagang;
use App\Models\PesertaMagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data user yang sedang login
        $user = User::findOrFail(Auth::id());

        // Ambil data mahasiswa berdasarkan user ID
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->firstOrFail();

        // Ambil data pelamar magang dengan status 'diterima'
        $pelamar_magang = PelamarMagang::where('id_mahasiswa', $mahasiswa->id)
            ->where('status_diterima', 'Diterima')
            ->firstOrFail();

        // Ambil data peserta magang berdasarkan pelamar magang
        $peserta_magang = PesertaMagang::where('id_pelamar_magang', $pelamar_magang->id)
            ->firstOrFail();

        $laporan_akhir = LaporanAkhirMagang::where('id_peserta_magang', $peserta_magang->id)->get();
        $laporan_akhir_count = LaporanAkhirMagang::where('id_peserta_magang', $peserta_magang->id)->count();

        $data = [
            'mahasiswa' => $mahasiswa,
            'pelamar_magang' => $pelamar_magang,
            'peserta_magang' => $peserta_magang,
            'laporan_akhir' => $laporan_akhir,
            'laporan_akhir_count' => $laporan_akhir_count,
        ];
        return view('pages.mahasiswa.laporan-akhir.index', $data);
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
        // Ambil data user yang sedang login
        $user = User::findOrFail(Auth::id());

        // Ambil data mahasiswa berdasarkan user ID
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->firstOrFail();

        // Ambil data pelamar magang dengan status 'diterima'
        $pelamar_magang = PelamarMagang::where('id_mahasiswa', $mahasiswa->id)
            ->where('status_diterima', 'Diterima')
            ->firstOrFail();

        // Ambil data peserta magang berdasarkan pelamar magang
        $peserta_magang = PesertaMagang::where('id_pelamar_magang', $pelamar_magang->id)
            ->firstOrFail();

        $validated = $request->validate(
            [
                'file' => ['required', 'mimes:pdf', 'max:20480'],
            ]
        );

        $saveData = [];

        // Mengecek apakah field untuk upload file sudah di-upload atau belum
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');

            // Simpan file di storage/app/public/mitra-foto dan ambil path relatif
            $path = $uploadedFile->store('laporan-akhir', 'public');

            // Simpan path relatif ke database
            $saveData['file'] = $path;
        }

        $laporan = new LaporanAkhirMagang();
        $laporan->file_laporan_akhir = $saveData['file'];
        $laporan->id_peserta_magang = $peserta_magang->id;
        $laporan->save();

        Alert::success('Succes', 'Laporan Akhir Berhasil Ditambahkan');
        return redirect()->route('mahasiswa.laporan.akhir.index');
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
        $laporan_akhir = LaporanAkhirMagang::findOrFail($id);

        // Periksa apakah ada file yang terkait dengan laporan_akhir
        if ($laporan_akhir->file_laporan_akhir != null) {
            // Pastikan path yang tersimpan di database adalah path relatif dari 'storage/app/public'
            $filePath = $laporan_akhir->file_laporan_akhir;

            // Periksa apakah file tersebut benar-benar ada di penyimpanan
            if (Storage::disk('public')->exists($filePath)) {
                // Hapus file terkait dari penyimpanan
                Storage::disk('public')->delete($filePath);
            }
        }

        // Hapus catatan dari database
        $laporan_akhir->delete();

        Alert::success('Success', 'Laporan Akhir Berhasil Dihapus');

        return redirect()->route('mahasiswa.laporan.akhir.index');
    }
}
