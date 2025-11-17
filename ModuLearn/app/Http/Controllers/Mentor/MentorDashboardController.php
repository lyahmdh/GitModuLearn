<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Module;

class MentorDashboardController extends Controller
{
    public function index()
    {
        $modules = Module::where('created_by', auth()->id())->get();

        return view('mentor.dashboard', compact('modules'));
    }
}
