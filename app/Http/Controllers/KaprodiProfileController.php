<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class KaprodiProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user =  User::where('id', Auth::user()->id)->first();

        $data = [
            'user' => $user,
        ];

        return view('profile.kaprodi-profile', $data);
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
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($id)],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($id)],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        // Persiapkan data yang akan diupdate
        $data = [
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];

        // Update password hanya jika field password diisi
        if (!$validated['password'] == null) {
            $data['password'] = Hash::make($validated['password']);
        }

        // Update data user
        User::where('id', $id)->update($data);

        Alert::success('Success', 'Profile Kaprodi Berhasil Diubah');

        return redirect()->route('profile.kaprodi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
