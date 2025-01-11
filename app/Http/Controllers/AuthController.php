<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    Alert::toast('Selamat datang ' . $user->name, 'success');
                    return redirect()->route('dashboard.admin');
                case 'dosen':
                    Alert::toast('Selamat datang ' . $user->name, 'success');
                    return redirect()->route('dashboard.dosen');
                case 'mahasiswa':
                    Alert::toast('Selamat datang ' . $user->name, 'success');
                    return redirect()->route('dashboard.mahasiswa');
                case 'dospem':
                    Alert::toast('Selamat datang ' . $user->name, 'success');
                    return redirect()->route('dashboard.dospem');
                case 'kaprodi':
                    Alert::toast('Selamat datang ' . $user->name, 'success');
                    return redirect()->route('dashboard.kaprodi');
                case 'koordinator':
                    Alert::toast('Selamat datang ' . $user->name, 'success');
                    return redirect()->route('dashboard.koordinator');
                case 'dpl':
                    Alert::toast('Selamat datang ' . $user->name, 'success');
                    return redirect()->route('dashboard.dpl');
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
        Session::flush();
        Auth::logout();
        Alert::toast('Anda baru saja logout ...', 'success');
        return redirect()->route('login');
    }
}
