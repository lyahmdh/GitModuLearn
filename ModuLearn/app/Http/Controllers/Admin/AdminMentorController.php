<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminMentorController extends Controller
{
    public function index()
    {
        $mentors = User::where('role', 'mentor')->get();
        return view('admin.mentors.index', compact('mentors'));
    }

    public function approve($id)
    {
        $mentor = User::findOrFail($id);

        $mentor->update([
            'is_verified' => true
        ]);

        return redirect()->back()->with('success', 'Mentor approved.');
    }

    public function reject($id)
    {
        $mentor = User::findOrFail($id);

        $mentor->update([
            'is_verified' => false
        ]);

        return redirect()->back()->with('success', 'Mentor rejected.');
    }
}
