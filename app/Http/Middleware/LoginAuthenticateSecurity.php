<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class LoginAuthenticateSecurity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,  $guard='admin'): Response
    {
        
        if(!Auth::guard($guard)->check()) { //error
            return redirect(route('admin.login'));
        }

        return $next($request);
    }
}