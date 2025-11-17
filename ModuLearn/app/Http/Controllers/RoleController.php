<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Switch role antara mentor <-> mentee.
     */
    public function switch()
    {
        $user = Auth::user();

        // Admin tidak boleh switch
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Admin cannot switch roles.');
        }

        // Toggle role
        if ($user->role === 'mentor') {
            $user->role = 'mentee';
        } else {
            $user->role = 'mentor';
        }

        $user->save();

        return redirect()->back()->with('success', 'Role switched successfully!');
    }
}
