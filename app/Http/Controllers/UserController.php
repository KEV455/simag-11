<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
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
            'create_name' => ['required', 'string', Rule::unique('users', 'name')],
            'create_username' => ['required', 'string', Rule::unique('users', 'username')],
            'create_email' => ['required', 'string', 'email', Rule::unique('users', 'email')],
            'create_password' => ['required', 'confirmed', 'min:8'], // `confirmed` mencocokkan dengan `password_confirmation`
            'create_role' => ['required'],
        ]);

        $user = new User;
        $user->name = $validated['create_name'];
        $user->username = $validated['create_username'];
        $user->email = $validated['create_email'];
        $user->password = Hash::make($validated['create_password']);
        $user->role = $validated['create_role'];
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
        // Mendapatkan ID pengguna yang sedang login
        $currentUserId = Auth::user()->id;

        // Jika ID pengguna yang ingin dihapus sama dengan ID pengguna yang sedang login
        if ($currentUserId == $id) {
            Alert::error('Error', 'Anda tidak bisa menghapus user diri sendiri.');
            return redirect()->route('admin.user.index');
        }

        // Menghapus user jika bukan diri sendiri
        $user = User::findOrFail($id);
        $user->delete();

        Alert::success('Success', 'User Berhasil Dihapus');
        return redirect()->route('admin.user.index');
    }
}
