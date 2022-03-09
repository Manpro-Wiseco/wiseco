<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCompanySession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('company')) {
            if (!auth()->user()) {
                return redirect()->route('login');
            } else {
                return redirect()->route('list-company');
            }
        } else {
            return $next($request);
        }
    }
}
