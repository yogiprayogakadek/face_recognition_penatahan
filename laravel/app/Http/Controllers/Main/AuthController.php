<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = auth()->user();

            if (!$user->is_active) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')
                    ->with('error', 'Akun Anda non-aktif. Silakan hubungi admin untuk informasi lebih lanjut.');
            }

            return redirect()->intended('/dashboard')
                ->with('success', 'Selamat datang, <strong>' . $user->pegawai->nama . '</strong>! Gunakan sistem dengan bijak.');
        }

        return back()->with('error', 'Email atau password salah.');
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
