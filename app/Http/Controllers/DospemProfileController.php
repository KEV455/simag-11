<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class DospemProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user =  User::where('id', Auth::user()->id)->first();

        $data = [
            'dosen' => Dosen::where('id_user', $user->id)->first(),
        ];

        return view('profile.dospem-profile', $data);
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
        $dosen = Dosen::where('id_user', $id)->first();

        // dd($dosen);

        $validated = $request->validate([
            // data dosen
            'nama_dosen' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($id, 'id')],
            'nomor_telp' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'nip' => ['required', 'string', 'size:18', 'alpha_num'],
            'nidn' => ['required', 'string', 'size:10', 'alpha_num'],
            'alamat' => ['nullable', 'string'],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($id, 'id')],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        // Persiapkan data yang akan diupdate
        $dataDosen = [
            'nama_dosen' => $validated['nama_dosen'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'email' => $validated['email'],
            'nomor_telp' => $validated['nomor_telp'],
            'nip' => $validated['nip'],
            'nidn' => $validated['nidn'],
            'alamat' => $validated['alamat'],
        ];

        $dataUser = [
            'name' => $validated['nama_dosen'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];

        // Update password hanya jika field password diisi
        if (!$validated['password'] == null) {
            $dataUser['password'] = Hash::make($validated['password']);
        }

        // Update data dosen dan user
        Dosen::where('id', $dosen->id)->update($dataDosen);
        User::where('id', $id)->update($dataUser);

        Alert::success('Success', 'Profile Dosen Pembimbing Berhasil Diubah');

        return redirect()->route('profile.dospem.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
