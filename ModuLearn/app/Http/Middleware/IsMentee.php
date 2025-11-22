<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsMentee{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'mentee') {
            return $next($request);
        }

        abort(403, 'Akses khusus mentee.');
    }
}
