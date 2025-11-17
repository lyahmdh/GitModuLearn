<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;

class LandingController extends Controller
{
    public function index()
    {
        $categories = Course::all();
        $latestModules = Module::latest()->take(6)->get();

        return view('web.landing', compact('categories', 'latestModules'));
    }

    public function about()
    {
        return view('web.about');
    }

    public function home()
    {
        return view('web.home');
    }
}
