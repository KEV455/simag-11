<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user =  User::where('id', Auth::user()->id)->first();

        $data = [
            'mahasiswa' => Mahasiswa::where('id_user', $user->id)->first(),
        ];

        return view('profile.mahasiswa-profile', $data);
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
        $mahasiswa = Mahasiswa::where('id_user', $id)->first();

        $validated = $request->validate([
            // data mahasiswa
            'nama_mahasiswa' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($id, 'id')],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        // Persiapkan data yang akan diupdate
        $dataMahasiswa = [
            'nama_mahasiswa' => $validated['nama_mahasiswa'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'email' => $validated['email'],
        ];

        $dataUser = [
            'name' => $validated['nama_mahasiswa'],
            'email' => $validated['email'],
        ];

        // Update password hanya jika field password diisi
        if (!$validated['password'] == null) {
            $dataUser['password'] = Hash::make($validated['password']);
        }

        // Update data mahasiswa dan user
        Mahasiswa::where('id', $mahasiswa->id)->update($dataMahasiswa);
        User::where('id', $id)->update($dataUser);

        Alert::success('Success', 'Profile Mahasiswa Berhasil Diubah');

        return redirect()->route('profile.mahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
