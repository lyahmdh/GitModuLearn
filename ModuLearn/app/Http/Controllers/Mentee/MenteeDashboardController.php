<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use App\Models\Appointment;

class MenteeDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $progress = Progress::where('user_id', $user->id)
            ->with('submodule.module')
            ->get();

        $appointments = Appointment::where('mentee_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('mentee.dashboard', compact('user', 'progress', 'appointments'));
    }
}
