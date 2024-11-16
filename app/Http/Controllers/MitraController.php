<?php

namespace App\Http\Controllers;

use App\Models\KategoriBidang;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Laravolt\Indonesia\IndonesiaService;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'mitras' => Mitra::all(),
        ];

        return view('pages.koordinator.mitra.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $indonesia = new IndonesiaService();

        $data = [
            'provinsis' => $indonesia->allProvinces(),
            'kotas' => $indonesia->allCities(),
            'kategori_bidangs' => KategoriBidang::all()
        ];

        return view('pages.koordinator.mitra.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input form
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string'],
            'narahubung' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'website' => ['required', 'string'],
            'status' => ['required', 'string'],
            'foto' => ['image', 'mimes:png,jpg,jpeg', 'max:5120'],
            'provinsi' => ['required', 'string'],
            'kota' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'deskripsi' => ['required', 'string'],
            'id_kategori_bidang' => ['required', 'string'],
        ]);


        // Jika validasi gagal, kembalikan ke form sebelumnya dengan error dan input lama
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil data yang sudah tervalidasi
        $validated = $validator->validated();

        $saveData = [];

        // Mengecek apakah field untuk upload file sudah di-upload atau belum
        if ($request->hasFile('foto')) {
            $uploadedFile = $request->file('foto');

            // Simpan file di storage/app/public/mitra-foto dan ambil path relatif
            $path = $uploadedFile->store('mitra-foto', 'public');

            // Simpan path relatif ke database
            $saveData['foto'] = $path;
        }

        // Menyimpan data ke database
        $mitra = new Mitra;
        $mitra->nama = $validated['nama'];
        $mitra->narahubung = $validated['narahubung'];
        $mitra->email = $validated['email'];
        $mitra->website = $validated['website'];
        $mitra->status = $validated['status'];
        $mitra->foto =  isset($saveData['foto']) ? $saveData['foto'] : null;
        $mitra->provinsi = $validated['provinsi'];
        $mitra->kota = $validated['kota'];
        $mitra->alamat = $validated['alamat'];
        $mitra->deskripsi = $validated['deskripsi'];
        $mitra->id_kategori_bidang = $validated['id_kategori_bidang'];
        $mitra->save();

        // Menampilkan alert sukses
        Alert::success('Success', 'Mitra Berhasil Ditambahkan');

        // Redirect ke halaman index mitra
        return redirect()->route('koordinator.mitra.index');
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
        $mitra = Mitra::findOrFail($id);

        $indonesia = new IndonesiaService();

        $data = [
            'mitra' => $mitra,
            'provinsis' => $indonesia->allProvinces(),
            'kotas' => $indonesia->allCities(),
            'kategori_bidangs' => KategoriBidang::all()
        ];

        return view('pages.koordinator.mitra.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mitra = Mitra::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama' => ['required', 'string'],
            'narahubung' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'website' => ['required', 'string'],
            'status' => ['required', 'string'],
            'foto' => ['image', 'mimes:png,jpg,jpeg', 'max:5120'], // Validasi foto
            'provinsi' => ['required', 'string'],
            'kota' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'deskripsi' => ['required', 'string'],
            'id_kategori_bidang' => ['required', 'string'],
        ]);

        // Menyiapkan data untuk update (tanpa foto)
        $updateData = [
            'nama' => $validated['nama'],
            'narahubung' => $validated['narahubung'],
            'email' => $validated['email'],
            'website' => $validated['website'],
            'status' => $validated['status'],
            'provinsi' => $validated['provinsi'],
            'kota' => $validated['kota'],
            'alamat' => $validated['alamat'],
            'deskripsi' => $validated['deskripsi'],
            'id_kategori_bidang' => $validated['id_kategori_bidang'],
        ];

        // Jika ada foto baru yang di-upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($mitra->foto && Storage::disk('public')->exists($mitra->foto)) {
                Storage::disk('public')->delete($mitra->foto);
            }

            // Simpan foto baru
            $uploadedFile = $request->file('foto');
            $fotoPath = $uploadedFile->store('mitra-foto', 'public');  // Simpan file ke 'storage/app/public/mitra-foto'

            // Tambahkan path foto baru ke data yang akan di-update
            $updateData['foto'] = $fotoPath;
        }

        // Update data mitra
        $mitra->update($updateData);

        Alert::success('Success', 'Mitra Berhasil Diupdate');

        return redirect()->route('koordinator.mitra.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mitra = Mitra::findOrFail($id);

        // Periksa apakah ada file yang terkait dengan mitra
        if ($mitra->foto != null) {
            // Pastikan path yang tersimpan di database adalah path relatif dari 'storage/app/public'
            $filePath = $mitra->foto;

            // Periksa apakah file tersebut benar-benar ada di penyimpanan
            if (Storage::disk('public')->exists($filePath)) {
                // Hapus file terkait dari penyimpanan
                Storage::disk('public')->delete($filePath);
            }
        }

        // Hapus catatan dari database
        $mitra->delete();

        Alert::success('Success', 'Mitra Berhasil Dihapus');

        return redirect()->route('koordinator.mitra.index');
    }
}
