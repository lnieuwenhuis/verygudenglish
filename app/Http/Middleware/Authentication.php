<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authentication
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::id()) {
            return redirect()->route('auth.login');
        }

        if (Auth::user()->type !== 'docent') {
            return redirect()->route('home');
        }
    }
}
