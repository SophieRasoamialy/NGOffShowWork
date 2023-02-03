<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\CDO;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CDOMiddleware
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
        if(Auth::user() && (CDO::where('user_id', Auth::user()->id)->exists() || Admin::where('user_id', Auth::user()->id)->exists()))
        {
            return $next($request);

        }
        return redirect()->route('login');
    }
}
