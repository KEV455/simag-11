<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MitraMandiri;
use App\Models\User;
use Illuminate\Http\Request;
use Laravolt\Indonesia\IndonesiaService;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PengajuanMitraMandiriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user =  User::where('id', Auth::user()->id)->first();
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();

        $data = [
            'mitras' => MitraMandiri::where('id_mahasiswa', $mahasiswa->id)->get(),
        ];

        return view('pages.mahasiswa.mitra-mandiri.index', $data);
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
        ];

        return view('pages.mahasiswa.mitra-mandiri.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // Validasi input form
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string'],
            'narahubung' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'provinsi' => ['required', 'string'],
            'kota' => ['required', 'string'],
            'alamat' => ['required', 'string'],
        ]);

        // Jika validasi gagal, kembalikan ke form sebelumnya dengan error dan input lama
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil data yang sudah tervalidasi
        $validated = $validator->validated();

        $mahasiswa = Mahasiswa::where('id_user', $id)->first();

        // Menyimpan data ke database
        $mitra_mandiri = new MitraMandiri();
        $mitra_mandiri->nama = $validated['nama'];
        $mitra_mandiri->narahubung = $validated['narahubung'];
        $mitra_mandiri->email = $validated['email'];
        $mitra_mandiri->provinsi = $validated['provinsi'];
        $mitra_mandiri->kota = $validated['kota'];
        $mitra_mandiri->alamat = $validated['alamat'];
        $mitra_mandiri->status_disetujui = 'Menunggu Persetujuan';
        $mitra_mandiri->id_mahasiswa = $mahasiswa->id;
        $mitra_mandiri->save();

        // Menampilkan alert sukses
        Alert::success('Success', 'Mitra Mandiri Berhasil Ditambahkan');

        // Redirect ke halaman index mitra
        return redirect()->route('mahasiswa.mitra.mandiri.index');
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
        $mitra_mandiri = MitraMandiri::findOrFail($id);

        // Hapus data dari database
        $mitra_mandiri->delete();

        Alert::success('Success', 'Mitra Mandiri Berhasil Dihapus');

        return redirect()->route('mahasiswa.mitra.mandiri.index');
    }
}
