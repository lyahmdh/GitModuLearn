<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mentor;
use App\Models\Course;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalMentors = User::where('role', 'mentor')->count();
        $totalCourses = Course::count();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalMentors', 'totalCourses'
        ));
    }
}
