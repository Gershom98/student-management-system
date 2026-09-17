<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- Hii ni muhimu sana

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param 
     * @param  \Closure  $next
     * @param  array  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Tumia Auth::check() badala ya auth()->check() ili kuepuka method undefined
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Angalia kama role ya mtumiaji ipo kwenye orodha iliyoruhusiwa
        if (!in_array($user->role, $roles)) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}