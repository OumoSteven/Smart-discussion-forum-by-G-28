<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsLecturer
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Allow both lecturers and admins
        if (!in_array(Auth::user()->role, ['lecturer', 'admin'])) {
            abort(403, 'Access denied. Only lecturers and admins can access this page.');
        }

        return $next($request);
    }
}
