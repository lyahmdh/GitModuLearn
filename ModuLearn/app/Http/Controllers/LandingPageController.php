<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Category;

class LandingPageController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // modul terbaru
        $latestModules = Modul::latest()->take(6)->get();

        return view('web.landing.index', compact('categories', 'latestModules'));
    }
}
