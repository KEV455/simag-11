<?php

namespace App\Http\Controllers;

use App\Models\DPLMitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class DPLProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user =  User::where('id', Auth::user()->id)->first();

        $data = [
            'dpl_mitra' => DPLMitra::where('email', $user->email)->first(),
            'user' => $user,
        ];

        return view('profile.dpl-profile', $data);
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
        $dpl_mitra = DPLMitra::findOrFail($id);
        $user = User::where('email', $dpl_mitra->email)->first();

        $validated = $request->validate([
            // data dpl dan user
            'nama' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($user->id, 'id')],
            'nomor_telp' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'tanggal_lahir' => ['required', 'date'],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($user->id, 'id')],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        // Persiapkan data yang akan diupdate
        $dataDplMitra = [
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'nomor_telp' => $validated['nomor_telp'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
        ];

        $dataUser = [
            'name' => $validated['nama'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];

        // Update password hanya jika field password diisi
        if (!$validated['password'] == null) {
            $dataUser['password'] = Hash::make($validated['password']);
        }

        // Update data dpl dan user
        DPLMitra::where('id', $id)->update($dataDplMitra);
        User::where('id', $user->id)->update($dataUser);

        Alert::success('Success', 'Profile DPL Berhasil Diubah');

        return redirect()->route('profile.dpl.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
