<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request) //semua role
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) { //laravel otomatis cari user
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'mentor') {
                return redirect()->route('mentor.dashboard');
            }

            return redirect()->route('mentee.dashboard');
        }

        return back()->withErrors(['login' => 'Email atau password salah.']);
    }

    public function adminLogin(Request $request) //validasi 
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors(['login' => 'Bukan akun admin']);
            }

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Email atau password salah']);
    }
}
