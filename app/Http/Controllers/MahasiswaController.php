<?php

namespace App\Http\Controllers;

use App\Imports\MahasiswaImport;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'mahasiswas' => Mahasiswa::all()
        ];

        return view('pages.admin.mahasiswa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'prodis' => Prodi::all(),
        ];

        return view('pages.admin.mahasiswa.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input form
        $validator = Validator::make($request->all(), [
            'nim' => ['required', 'string'],
            'nama_mahasiswa' => ['required', 'string'],
            'angkatan' => ['required'],
            'email' => ['required', 'email'],
            'jenis_kelamin' => ['required', 'string'],
            'id_prodi' => ['required', 'string'],
        ]);

        // Jika validasi gagal, kembalikan ke form sebelumnya dengan error dan input lama
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil data yang sudah tervalidasi
        $validated = $validator->validated();

        // create data user
        $userMahasiswa = new User();
        $userMahasiswa->name = $validated['nama_mahasiswa'];
        $userMahasiswa->username = $validated['nim'];
        $userMahasiswa->email = $validated['email'];
        $userMahasiswa->password = Hash::make($validated['nim']);
        $userMahasiswa->role = 'mahasiswa';
        $userMahasiswa->save();

        // Menyimpan data ke database
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = $validated['nim'];
        $mahasiswa->nama_mahasiswa = $validated['nama_mahasiswa'];
        $mahasiswa->angkatan = $validated['angkatan'];
        $mahasiswa->email = $validated['email'];
        $mahasiswa->jenis_kelamin = $validated['jenis_kelamin'];
        $mahasiswa->id_prodi = $validated['id_prodi'];
        $mahasiswa->id_user = $userMahasiswa->id;
        $mahasiswa->save();

        // Menampilkan alert sukses
        Alert::success('Success', 'Mahasiswa Berhasil Ditambahkan');

        // Redirect ke halaman index mitra
        return redirect()->route('admin.mahasiswa.index');
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
        $mahasiswa = Mahasiswa::findOrFail($id);

        $data = [
            'mahasiswa' => $mahasiswa,
            'prodis' => Prodi::all(),
        ];

        return view('pages.admin.mahasiswa.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nim' => ['required', 'string'],
            'nama_mahasiswa' => ['required', 'string'],
            'angkatan' => ['required'],
            'email' => ['required', 'email'],
            'jenis_kelamin' => ['required', 'string'],
            'id_prodi' => ['required', 'string'],
        ]);

        // Cek apakah ada perubahan pada nama_mahasiswa atau email
        $isNamaBerubah = $mahasiswa->nama_mahasiswa !== $validated['nama_mahasiswa'];
        $isEmailBerubah = $mahasiswa->email !== $validated['email'];
        $isNimBerubah = $mahasiswa->nim !== $validated['nim'];

        // Update data user jika ada perubahan pada nama_mahasiswa atau email
        if ($isNamaBerubah || $isEmailBerubah || $isNimBerubah) {
            $user = User::find($mahasiswa->id_user);

            if ($user) {
                $user->update([
                    'name' => $validated['nama_mahasiswa'],
                    'email' => $validated['email'],
                    'username' => $validated['nim'],
                    'password' => Hash::make($validated['nim']),
                ]);
            }
        }

        $updateData = [
            'nim' => $validated['nim'],
            'nama_mahasiswa' => $validated['nama_mahasiswa'],
            'angkatan' => $validated['angkatan'],
            'email' => $validated['email'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'id_prodi' => $validated['id_prodi'],
        ];

        // Update data mahasiswa
        $mahasiswa->update($updateData);

        Alert::success('Success', 'Mahasiswa Berhasil Diupdate');

        return redirect()->route('admin.mahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::find($mahasiswa->id_user);
        $mahasiswa->delete();
        $user->delete();

        Alert::success('Success', 'Mahasiswa Berhasil Dihapus');

        return redirect()->route('admin.mahasiswa.index');
    }

    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        // Mengecek apakah ada file yang diunggah
        if ($request->hasFile('file')) {
            // Simpan file yang diunggah ke folder 'import/mahasiswa' di disk 'public'
            $uploadedFile = $request->file('file');
            $filePath = $uploadedFile->store('import/mahasiswa', 'public');

            try {
                // Dapatkan path absolut dari file
                $absolutePath = Storage::disk('public')->path($filePath);

                // Import data mahasiswa dari file yang diunggah
                Excel::import(new MahasiswaImport(), $absolutePath);

                // Hapus file setelah import berhasil
                Storage::disk('public')->delete($filePath);

                // Beri notifikasi sukses
                Alert::success('Success', 'Data Mahasiswa Berhasil Diimport');
            } catch (\Exception $e) {
                // Beri notifikasi jika terjadi kesalahan
                Alert::error('Error', 'Data Mahasiswa Gagal Diimport: ' . $e->getMessage());

                // Hapus file jika terjadi kesalahan
                Storage::disk('public')->delete($filePath);
            }

            // Redirect ke halaman sebelumnya
            return redirect()->back();
        }

        // Jika tidak ada file yang diunggah
        Alert::error('Error', 'Tidak ada file yang diunggah');
        return redirect()->back();
    }
}
