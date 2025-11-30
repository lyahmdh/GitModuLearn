<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasVerifiedMentor
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || $request->user()->role !== 'mentor') {
            abort(403, 'Anda bukan mentor.');
        }
        
        $verification = $request->user()->mentorVerifications()->latest()->first();
        
        if (!$verification || $verification->status !== 'approved') {
            abort(403, 'Akun Anda belum diverifikasi sebagai mentor.');
        }
        
        return $next($request);
        
    }
}
