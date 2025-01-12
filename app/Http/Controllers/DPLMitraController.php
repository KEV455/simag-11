<?php

namespace App\Http\Controllers;

use App\Models\DPLMitra;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class DPLMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = [
            'dpl_mitras' => DPLMitra::where('id_mitra', $id)->get(),
            'mitra' => Mitra::findOrFail($id),
        ];

        return view('pages.koordinator.dpl-mitra.index', $data);
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
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'create_nama' => ['required'],
            'create_tanggal_lahir' => ['required', 'date'],
            'create_email' => ['required', 'email'],
            'create_nomor_telp' => ['nullable', 'numeric', 'regex:/^\+?[0-9]{10,15}$/'],
        ]);

        // create data dpl mitra
        DPLMitra::create([
            'nama' => $validated['create_nama'],
            'tanggal_lahir' => $validated['create_tanggal_lahir'],
            'email' => $validated['create_email'],
            'nomor_telp' => $validated['create_nomor_telp'],
            'id_mitra' => $id,
        ]);

        // Konversi tanggal lahir ke format ddmmyyyy
        $tanggal_lahir_convert = \Carbon\Carbon::parse($validated['create_tanggal_lahir'])->format('dmY');

        // create data user dpl
        $user = new User();
        $user->name = $validated['create_nama'];
        $user->username = $validated['create_email'];
        $user->email = $validated['create_email'];
        $user->password = Hash::make($tanggal_lahir_convert);
        $user->role = 'dpl';
        $user->save();

        Alert::success('Success', 'DPL Mitra Berhasil Ditambahkan');

        return redirect()->route('koordinator.dpl.mitra.index', $id);
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
        $dpl_mitra = DPLMitra::findOrFail($id);
        $user = User::where('username', $dpl_mitra->email)->first();

        $validated = $request->validate([
            'update_nama' => ['required'],
            'update_tanggal_lahir' => ['required', 'date'],
            'update_email' => ['required', 'email'],
            'update_nomor_telp' => ['nullable', 'numeric', 'regex:/^\+?[0-9]{10,15}$/'],
        ]);

        DPLMitra::where('id', $id)->update([
            'nama' => $validated['update_nama'],
            'tanggal_lahir' => $validated['update_tanggal_lahir'],
            'email' => $validated['update_email'],
            'nomor_telp' => $validated['update_nomor_telp'],
        ]);

        // Konversi tanggal lahir ke format ddmmyyyy
        $tanggal_lahir_convert = \Carbon\Carbon::parse($validated['update_tanggal_lahir'])->format('dmY');
        $tanggal_lahir_to_password = Hash::make($tanggal_lahir_convert);

        // Persiapkan data yang akan diupdate untuk user
        $data = [
            'name' => $validated['update_nama'],
            'username' => $validated['update_email'],
            'email' => $validated['update_email'],
            'password' => $tanggal_lahir_to_password,
        ];

        // Update data user
        User::where('id', $user->id)->update($data);

        Alert::success('Success', 'DPL Mitra Berhasil Diupdate');

        return redirect()->route('koordinator.dpl.mitra.index', $dpl_mitra->id_mitra);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dpl_mitra = DPLMitra::findOrFail($id);
        $id_mitra = $dpl_mitra->id_mitra;
        $user = User::where('username', $dpl_mitra->email)->first();

        // menghapus data dpl dan user nya
        $dpl_mitra->delete();
        $user->delete();

        Alert::success('Success', 'DPL Mitra Berhasil Dihapus');

        return redirect()->route('koordinator.dpl.mitra.index', $id_mitra);
    }
}
