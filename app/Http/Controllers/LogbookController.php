<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Lowongan;
use App\Models\Mahasiswa;
use App\Models\PelamarMagang;
use App\Models\PesertaMagang;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data tahun ajaran yang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        // Ambil data user yang sedang login
        $user = User::findOrFail(Auth::id());

        // Ambil data mahasiswa berdasarkan user ID
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->firstOrFail();

        // Ambil data pelamar magang dengan status 'diterima'
        $pelamar_magang = PelamarMagang::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id_mahasiswa', $mahasiswa->id)->where('status_diterima', 'Diterima')->first();

        if (!$pelamar_magang) {
            Alert::info('Oops', 'Maaf, Anda tidak terdaftar di program magang sekarang.');
            return redirect()->route('dashboard.mahasiswa');
        }

        // Ambil data peserta magang berdasarkan pelamar magang
        $peserta_magang = PesertaMagang::where('id_pelamar_magang', $pelamar_magang->id)
            ->firstOrFail();

        // Ambil logbook berdasarkan id_peserta_magang
        $logbooks = Logbook::where('id_peserta_magang', $peserta_magang->id)->get();

        // Ambil data lowongan
        $lowongan = $pelamar_magang->lowongan;

        // Return data ke view
        return view('pages.mahasiswa.logbook.index', compact('logbooks', 'pelamar_magang', 'peserta_magang', 'lowongan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Ambil data tahun ajaran yang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        // Ambil data user yang sedang login
        $user = User::findOrFail(Auth::id());

        // Ambil data mahasiswa berdasarkan user ID
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->firstOrFail();

        $peserta_magang = PesertaMagang::findOrFail($id);

        // Pastikan query untuk PelamarMagang memeriksa keberadaan data dengan benar
        $pelamar_magang = PelamarMagang::where('id_semester', $tahun_ajaran_aktif->id_semester)
            ->where('id', $peserta_magang->id_pelamar_magang)->where('id_mahasiswa', $mahasiswa->id)->first();

        if (!$pelamar_magang) {
            Alert::info('Oops', 'Maaf, Anda tidak terdaftar di program magang ini.');
            return redirect()->route('dashboard.mahasiswa');
        }

        $lowongan = Lowongan::findOrFail($pelamar_magang->id_lowongan);

        // Validasi: cek apakah tanggal sekarang berada dalam rentang tanggal magang
        $currentDate = now();

        if ($currentDate < $lowongan->tanggal_magang_dimulai || $currentDate > $lowongan->tanggal_magang_ditutup) {
            Alert::info('Oops', 'Anda hanya dapat mengakses fitur ini selama periode magang berlangsung.');
            return redirect()->back();
        }

        $data = [
            'peserta_magang' => $peserta_magang
        ];

        return view('pages.mahasiswa.logbook.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $peserta_magang = PesertaMagang::findOrFail($id);
        $pelamar_magang = PelamarMagang::findOrFail($peserta_magang->id_pelamar_magang);
        $lowongan = Lowongan::findOrFail($pelamar_magang->id_lowongan);

        // Validasi input form
        $validator = Validator::make($request->all(), [
            'judul_kegiatan' => ['required', 'string'],
            'tanggal_kegiatan' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($lowongan) {
                    $tanggalMulai = $lowongan->tanggal_magang_dimulai;
                    $tanggalSelesai = $lowongan->tanggal_magang_ditutup;
                    $now = now()->toDateString();

                    if ($value < $tanggalMulai || $value > $tanggalSelesai) {
                        $fail("Tanggal kegiatan harus berada dalam rentang $tanggalMulai hingga $tanggalSelesai.");
                    }

                    if ($value > $now) {
                        $fail("Tidak boleh memasukkan tanggal kegiatan yang akan datang.");
                    }
                }
            ],
            'dokumentasi' => ['image', 'mimes:png,jpg,jpeg', 'max:5120'],
            'deskripsi' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        // Jika validasi gagal, kembalikan ke form sebelumnya dengan error dan input lama
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil data yang sudah tervalidasi
        $validated = $validator->validated();

        // Cek apakah sudah ada data dengan tanggal_kegiatan yang sama untuk id_peserta_magang ini
        $existingLogbook = Logbook::where('id_peserta_magang', $id)
            ->where('tanggal_kegiatan', $validated['tanggal_kegiatan'])
            ->first();

        if ($existingLogbook) {
            // Jika ada, kembalikan pesan error
            return redirect()->back()
                ->withErrors(['tanggal_kegiatan' => 'Logbook untuk tanggal tersebut sudah ada.'])
                ->withInput();
        }

        $saveData = [];

        // Mengecek apakah field untuk upload file sudah di-upload atau belum
        if ($request->hasFile('dokumentasi')) {
            $uploadedFile = $request->file('dokumentasi');

            // Simpan file di storage/app/public/dokumentasi-kegiatan dan ambil path relatif
            $path = $uploadedFile->store('dokumentasi-kegiatan', 'public');

            // Simpan path relatif ke database
            $saveData['dokumentasi'] = $path;
        }

        // Simpan data logbook baru
        Logbook::create([
            'judul_kegiatan' => $validated['judul_kegiatan'],
            'status_kehadiran' => $validated['status'],
            'dokumentasi_kegiatan' => isset($saveData['dokumentasi']) ? $saveData['dokumentasi'] : null,
            'deskripsi_kegiatan' => $validated['deskripsi'],
            'tanggal_kegiatan' => $validated['tanggal_kegiatan'],
            'id_peserta_magang' => $id,
        ]);

        Alert::success('Success', 'Logbook Berhasil Ditambahkan');

        return redirect()->route('mahasiswa.logbook.index');
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
        // Ambil data tahun ajaran yang aktif
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        // Ambil data user yang sedang login
        $user = User::findOrFail(Auth::id());

        // Ambil data mahasiswa berdasarkan user ID
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->firstOrFail();

        $logbook = Logbook::findOrFail($id);

        // get data peserta magang
        $peserta_magang = PesertaMagang::findOrFail($logbook->id_peserta_magang);

        // Pastikan query untuk PelamarMagang memeriksa keberadaan data dengan benar
        $pelamar_magang = PelamarMagang::where('id_semester', $tahun_ajaran_aktif->id_semester)
            ->where('id', $peserta_magang->id_pelamar_magang)->where('id_mahasiswa', $mahasiswa->id)->first();

        if (!$pelamar_magang) {
            Alert::info('Oops', 'Maaf, Anda tidak terdaftar di program magang ini.');
            return redirect()->route('dashboard.mahasiswa');
        }

        $data = [
            'logbook' => $logbook
        ];

        return view('pages.mahasiswa.logbook.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $logbook = Logbook::findOrFail($id);
        $peserta_magang = PesertaMagang::findOrFail($logbook->id_peserta_magang);
        $pelamar_magang = PelamarMagang::findOrFail($peserta_magang->id_pelamar_magang);
        $lowongan = Lowongan::findOrFail($pelamar_magang->id_lowongan);

        // Validasi input form
        $validator = Validator::make($request->all(), [
            'judul_kegiatan' => ['required', 'string'],
            'tanggal_kegiatan' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($lowongan) {
                    $tanggalMulai = $lowongan->tanggal_magang_dimulai;
                    $tanggalSelesai = $lowongan->tanggal_magang_ditutup;
                    $now = now()->toDateString();

                    if ($value < $tanggalMulai || $value > $tanggalSelesai) {
                        $fail("Tanggal kegiatan harus berada dalam rentang $tanggalMulai hingga $tanggalSelesai.");
                    }

                    if ($value > $now) {
                        $fail("Tidak boleh memasukkan tanggal kegiatan yang akan datang.");
                    }
                }
            ],
            'dokumentasi' => ['image', 'mimes:png,jpg,jpeg', 'max:5120'],
            'deskripsi' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        // Jika validasi gagal, kembalikan ke form sebelumnya dengan error dan input lama
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil data yang sudah tervalidasi
        $validated = $validator->validated();

        // Ambil logbook yang akan diperbarui
        $logbook = Logbook::findOrFail($id);

        // Cek apakah tanggal_kegiatan sudah digunakan oleh logbook lain milik id_peserta_magang yang sama
        $existingLogbook = Logbook::where('id_peserta_magang', $logbook->id_peserta_magang)
            ->where('tanggal_kegiatan', $validated['tanggal_kegiatan'])
            ->where('id', '!=', $id) // Pastikan tidak mengecek data logbook saat ini
            ->first();

        if ($existingLogbook) {
            // Jika ada, kembalikan pesan error
            return redirect()->back()
                ->withErrors(['tanggal_kegiatan' => 'Logbook untuk tanggal tersebut sudah ada.'])
                ->withInput();
        }

        // Mengecek apakah field untuk upload file sudah di-upload atau belum
        if ($request->hasFile('dokumentasi')) {
            $uploadedFile = $request->file('dokumentasi');

            // Simpan file di storage/app/public/dokumentasi-kegiatan dan ambil path relatif
            $path = $uploadedFile->store('dokumentasi-kegiatan', 'public');

            // Simpan path relatif ke database
            $logbook->dokumentasi_kegiatan = $path;
        }

        // Perbarui data logbook
        $logbook->update([
            'judul_kegiatan' => $validated['judul_kegiatan'],
            'status_kehadiran' => $validated['status'],
            'deskripsi_kegiatan' => $validated['deskripsi'],
            'tanggal_kegiatan' => $validated['tanggal_kegiatan'],
        ]);

        Alert::success('Success', 'Logbook Berhasil Diperbarui');

        return redirect()->route('mahasiswa.logbook.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $logbook = Logbook::findOrFail($id);

        // Periksa apakah ada file yang terkait dengan logbook
        if ($logbook->dokumentasi_kegiatan != null) {
            // Pastikan path yang tersimpan di database adalah path relatif dari 'storage/app/public'
            $filePath = $logbook->dokumentasi_kegiatan;

            // Periksa apakah file tersebut benar-benar ada di penyimpanan
            if (Storage::disk('public')->exists($filePath)) {
                // Hapus file terkait dari penyimpanan
                Storage::disk('public')->delete($filePath);
            }
        }

        // Hapus catatan dari database
        $logbook->delete();

        Alert::success('Success', 'Logbook Berhasil Dihapus');

        return redirect()->route('mahasiswa.logbook.index');
    }
}
