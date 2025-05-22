<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        if ($user && $user->is_admin === true) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access. Admin privileges required.');
    }
}
