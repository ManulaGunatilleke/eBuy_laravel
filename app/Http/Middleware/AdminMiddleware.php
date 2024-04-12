<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->role_as == '1') {
            // Return a redirect response with status code 403 (Forbidden)
            // return redirect()->route('status')->with('error', 'Access Denied. Possible Reason: You are Not Admin');
            return redirect('/home')->with('status','Access Denied. Possible Reason: You are Not Admin');
        }
        return $next($request);
    }
}
