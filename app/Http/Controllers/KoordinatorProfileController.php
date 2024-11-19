<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class KoordinatorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user =  User::where('id', Auth::user()->id)->first();

        $data = [
            'koordinator' => Koordinator::where('id_user', $user->id)->first(),
        ];

        return view('profile.koordinator-profile', $data);
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
        $koordinator = Koordinator::where('id_user', $id)->first();

        $validated = $request->validate([
            // data dosen
            'nama' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($id, 'id')],
            'nomor_telp' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($id, 'id')],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        // Persiapkan data yang akan diupdate
        $dataKoordinator = [
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'nomor_telp' => $validated['nomor_telp'],
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

        // Update data dosen dan user
        Koordinator::where('id', $koordinator->id)->update($dataKoordinator);
        User::where('id', $id)->update($dataUser);

        Alert::success('Success', 'Profile Koordinator Berhasil Diubah');

        return redirect()->route('profile.koordinator.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
