<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Models\ModuleProgress;

class MenteeDashboardController extends Controller
{
    public function index()
    {
        $progress = ModuleProgress::where('user_id', auth()->id())->get();

        return view('mentee.dashboard', compact('progress'));
    }
}
