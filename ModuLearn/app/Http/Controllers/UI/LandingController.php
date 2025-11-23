<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function index()
    {
        // Jika user belum login, tampilkan landing utama
        return view('landing.index');
    }

    public function landingLogin()
    {
        // Tampilkan view langsung, tanpa redirect
        return view('landing-login.index');
    }
    
}

