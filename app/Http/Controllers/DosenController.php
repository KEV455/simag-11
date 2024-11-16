<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Imports\DosenImport;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'dosens' => Dosen::all(),
        ];

        return view('pages.admin.dosen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'prodis' => Prodi::all(),
        ];

        return view('pages.admin.dosen.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input form
        $validator = Validator::make($request->all(), [
            'nama_dosen' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'nomor_telp' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'jenis_kelamin' => ['required', 'string'],
            'nip' => ['required', 'string', 'size:18', 'alpha_num'],
            'nidn' => ['required', 'string', 'size:10', 'alpha_num'],
            'alamat' => ['nullable', 'string'],
            'id_prodi' => ['required', 'string'],
        ]);


        // Jika validasi gagal, kembalikan ke form sebelumnya dengan error dan input lama
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil data yang sudah tervalidasi
        $validated = $validator->validated();

        // create data user
        $userDosen = new User();
        $userDosen->name = $validated['nama_dosen'];
        $userDosen->username = $validated['email'];
        $userDosen->email = $validated['email'];
        $userDosen->password = Hash::make(12345678);
        $userDosen->role = 'dosen';
        $userDosen->save();

        // Menyimpan data ke database
        $dosen = new Dosen();
        $dosen->nama_dosen = $validated['nama_dosen'];
        $dosen->email = $validated['email'];
        $dosen->nomor_telp = $validated['nomor_telp'];
        $dosen->jenis_kelamin = $validated['jenis_kelamin'];
        $dosen->nip = $validated['nip'];
        $dosen->nidn = $validated['nidn'];
        $dosen->alamat = $validated['alamat'];
        $dosen->id_prodi = $validated['id_prodi'];
        $dosen->id_user = $userDosen->id;
        $dosen->save();

        // Menampilkan alert sukses
        Alert::success('Success', 'Dosen Berhasil Ditambahkan');

        // Redirect ke halaman index mitra
        return redirect()->route('admin.dosen.index');
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
        $dosen = Dosen::findOrFail($id);

        $data = [
            'dosen' => $dosen,
            'prodis' => Prodi::all(),
        ];

        return view('pages.admin.dosen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id);
        $dosen = Dosen::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama_dosen' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'nomor_telp' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'jenis_kelamin' => ['required', 'string'],
            'nip' => ['required', 'string', 'size:18', 'alpha_num'],
            'nidn' => ['required', 'string', 'size:10', 'alpha_num'],
            'alamat' => ['nullable', 'string'],
            'id_prodi' => ['required', 'string'],
        ]);

        // Cek apakah ada perubahan pada nama_dosen atau email
        $isNamaBerubah = $dosen->nama_dosen !== $validated['nama_dosen'];
        $isEmailBerubah = $dosen->email !== $validated['email'];

        // Update data user jika ada perubahan pada nama_dosen atau email
        if ($isNamaBerubah || $isEmailBerubah) {
            $user = User::find($dosen->id_user);

            if ($user) {
                $user->update([
                    'name' => $validated['nama_dosen'],
                    'email' => $validated['email'],
                    'username' => $validated['email'],
                ]);
            }
        }

        $updateData = [
            'nama_dosen' => $validated['nama_dosen'],
            'email' => $validated['email'],
            'nomor_telp' => $validated['nomor_telp'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'nip' => $validated['nip'],
            'nidn' => $validated['nidn'],
            'alamat' => $validated['alamat'],
            'id_prodi' => $validated['id_prodi'],
        ];

        // Update data dosen
        $dosen->update($updateData);

        Alert::success('Success', 'Dosen Berhasil Diupdate');

        return redirect()->route('admin.dosen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = User::find($dosen->id_user);
        $dosen->delete();
        $user->delete();

        Alert::success('Success', 'Dosen Berhasil Dihapus');

        return redirect()->route('admin.dosen.index');
    }

    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        // Mengecek apakah ada file yang diunggah
        if ($request->hasFile('file')) {
            // Simpan file yang diunggah ke folder 'import/dosen' di disk 'public'
            $uploadedFile = $request->file('file');
            $filePath = $uploadedFile->store('import/dosen', 'public');

            try {
                // Dapatkan path absolut dari file
                $absolutePath = Storage::disk('public')->path($filePath);

                // Import data dosen dari file yang diunggah
                Excel::import(new DosenImport(), $absolutePath);

                // Hapus file setelah import berhasil
                Storage::disk('public')->delete($filePath);

                // Beri notifikasi sukses
                Alert::success('Success', 'Data Dosen Berhasil Diimport');
            } catch (\Exception $e) {
                // Beri notifikasi jika terjadi kesalahan
                Alert::error('Error', 'Data Dosen Gagal Diimport: ' . $e->getMessage());

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
