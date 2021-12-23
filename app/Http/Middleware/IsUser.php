<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUser
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role_id == 2) {
            return $next($request);
        }

        return redirect('home')->with('error', "Your role not user.");
    }
}
