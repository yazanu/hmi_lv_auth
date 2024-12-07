<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class IsActive
{
    //php artisan make:middleware IsActive
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if(!auth()->user()->is_active){
                return response()->json('Your account is inactive');
            }
            return $next($request);
        } else {
            abort(401, 'Unauthorized');
        }
        
        
    }
}
