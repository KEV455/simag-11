<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role) {
                case 'mahasiswa':
                    return redirect()->route('dashboard.mahasiswa');
                case 'dospem':
                    return redirect()->route('dashboard.dospem');
                case 'kaprodi':
                    return redirect()->route('dashboard.kaprodi');
                case 'koordinator':
                    return redirect()->route('dashboard.koordinator');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors('Role tidak dikenali.');
            }
        }

        return back()->withErrors('Login gagal, periksa username dan password.');
    }

    public function showProfile()
    {
        $user = Auth::user(); // Mengambil data user yang sedang login
        return view('profile', compact('user'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
