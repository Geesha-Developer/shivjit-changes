<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckGuards
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated with 'teamlead' guard
        if (Auth::guard('teamlead')->check()) {
            // User is authenticated with 'teamlead' guard
            return $next($request);
        }

        // Check if the user is authenticated with 'web' guard
        if (Auth::guard('web')->check()) {
            // User is authenticated with 'web' guard
            return $next($request);
        }

        // If not authenticated with either guard, redirect or return an error
        return redirect()->route('login'); // Adjust the redirect as needed
    }
}
