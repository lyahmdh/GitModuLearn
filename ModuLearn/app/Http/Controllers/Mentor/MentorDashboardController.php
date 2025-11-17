<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Appointment;

class MentorDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $myModules = Module::where('mentor_id', $user->id)->get();

        $appointments = Appointment::where('mentor_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('mentor.dashboard', compact('user', 'myModules', 'appointments'));
    }
}
