<?php

namespace App\Http\Controllers;

use App\Models\Course; // FIXED
use App\Models\Module;

class LandingPageController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $modules = Module::latest()->take(6)->get();

        return view('landing.index', compact('courses', 'modules'));
    }
}
