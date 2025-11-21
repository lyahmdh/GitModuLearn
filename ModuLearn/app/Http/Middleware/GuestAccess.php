<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestAccess
{
    public function handle(Request $request, Closure $next)
    {
        // jika belum login, tetap boleh masuk
        if (!$request->user()) {
            return $next($request);
        }

        // jika user login, tetap bisa akses tanpa masalah
        return $next($request);
    }
}
