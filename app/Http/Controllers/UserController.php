<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'user' => User::all(),
        ];
        return view('pages.admin.user.index', $data);
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
        $validated = $request->validate([
            'nama' => ['required', 'string', Rule::unique('users', 'name')],
            'username' => ['required', 'string', Rule::unique('users', 'username')],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:8'], // `confirmed` mencocokkan dengan `password_confirmation`
            'role' => ['required'],
        ]);

        $slug = Str::slug($validated['nama']);
        $user = new User;
        $user->name = $slug;
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->password = Hash::make($request->password);
        $user->role = $validated['role'];
        $user->save();

        Alert::success('Success', 'User Berhasil Ditambahkan');

        return redirect()->route('admin.user.index');
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
        //
    }
}
