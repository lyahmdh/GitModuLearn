<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenteeProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('mentee.profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email'
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
