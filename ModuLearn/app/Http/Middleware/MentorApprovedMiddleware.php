<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MentorApprovedMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // If user is not mentor
        if ($user->role !== 'mentor') {
            return abort(403, 'Access denied. Only mentors allowed.');
        }

        // Mentor but not yet approved
        if ($user->approval_status !== 'approved') {
            return redirect()
                ->route('mentor.dashboard')
                ->with('warning', 'Your mentor account is pending admin approval.');
        }

        return $next($request);
    }
}
