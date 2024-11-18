<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Session()->has('id_pelanggan')){
            return redirect('login')->with('fail','You have to login first.');
        }
        if(Session()->get('role') !== 'admin'){
            return back();
        }
        return $next($request);
    }
}
