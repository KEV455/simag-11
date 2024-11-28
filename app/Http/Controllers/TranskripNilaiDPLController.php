<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\NilaiMagang;
use App\Models\PelamarMagang;
use App\Models\PesertaMagang;
use App\Models\TranskripNilaiDPL;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TranskripNilaiDPLController extends Controller
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

        $transkrip_nilai_dpl = TranskripNilaiDPL::where('id_peserta_magang', $peserta_magang->id)->get();
        $transkrip_nilai_dpl_count = TranskripNilaiDPL::where('id_peserta_magang', $peserta_magang->id)->count();
        $transkrip_nilai_dpl_count = $transkrip_nilai_dpl->count(); // Hitung jumlah data dari koleksi
        $flag_transkrip = false;

        if ($transkrip_nilai_dpl_count > 0) {
            $flag_transkrip = true;
        }

        $data = [
            'transkrip_nilai_dpl' => $transkrip_nilai_dpl,
            'transkrip_nilai_dpl_count' => $transkrip_nilai_dpl_count,
            'flag_transkrip' => $flag_transkrip
        ];

        return view('pages.mahasiswa.transkrip-nilai-dpl.index', $data);
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

        $request->validate(
            [
                'file' => ['required', 'mimes:pdf', 'max:5120'],
            ]
        );

        $saveData = [];

        // Mengecek apakah field untuk upload file sudah di-upload atau belum
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');

            // Simpan file di storage/app/public/transkrip-nilai-dpl dan ambil path relatif
            $path = $uploadedFile->store('transkrip-nilai-dpl', 'public');

            // Simpan path relatif ke database
            $saveData['file'] = $path;
        }

        $laporan = new TranskripNilaiDPL();
        $laporan->file_transkrip_nilai = $saveData['file'];
        $laporan->id_peserta_magang = $peserta_magang->id;
        $laporan->save();

        Alert::success('Succes', 'Transkrip Nilai DPL Berhasil Ditambahkan');
        return redirect()->route('mahasiswa.transkrip.nilai.dpl.index');
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
        $transkrip_nilai_dpl = TranskripNilaiDPL::findOrFail($id);

        // mengecek apakah data transkrip nilai memiliki data nilai yang sudah disetujui
        $nilai_magang = NilaiMagang::where('id_transkrip_nilai_dpl', $id)->first();

        if ($nilai_magang) {
            // Menampilkan alert
            Alert::info('Invalid', 'Transkrip nilai tidak diizinkan untuk dihapus');
            return redirect()->back();
        }

        // Periksa apakah ada file yang terkait dengan transkrip_nilai_dpl
        if ($transkrip_nilai_dpl->file_transkrip_nilai != null) {
            // Pastikan path yang tersimpan di database adalah path relatif dari 'storage/app/public'
            $filePath = $transkrip_nilai_dpl->file_transkrip_nilai;

            // Periksa apakah file tersebut benar-benar ada di penyimpanan
            if (Storage::disk('public')->exists($filePath)) {
                // Hapus file terkait dari penyimpanan
                Storage::disk('public')->delete($filePath);
            }
        }

        // Hapus catatan dari database
        $transkrip_nilai_dpl->delete();

        Alert::success('Success', 'Transkrip Nilai DPL Berhasil Dihapus');

        return redirect()->route('mahasiswa.transkrip.nilai.dpl.index');
    }
}
