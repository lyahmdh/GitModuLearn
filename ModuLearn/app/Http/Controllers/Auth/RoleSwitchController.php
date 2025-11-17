<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleSwitchController extends Controller
{
    public function switchToMentor()
    {
        $user = Auth::user();

        if ($user->role !== 'mentee') {
            return back()->withErrors(['role' => 'Hanya mentee yang bisa menjadi mentor.']);
        }

        if (!$user->is_approved) {
            return back()->withErrors(['role' => 'Akun mentor kamu belum disetujui admin.']);
        }

        session(['active_role' => 'mentor']);
        return redirect()->route('mentor.dashboard');
    }

    public function switchToMentee()
    {
        session(['active_role' => 'mentee']);
        return redirect()->route('mentee.dashboard');
    }
}
