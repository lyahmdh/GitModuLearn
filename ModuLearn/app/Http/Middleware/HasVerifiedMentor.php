<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasVerifiedMentor
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'mentor') {
            return $next($request);
        }

        abort(403, 'Anda belum diverifikasi sebagai mentor.');
    }
}
