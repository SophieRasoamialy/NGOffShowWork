<?php

namespace App\Http\Middleware;

use App\Models\Developpeur;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeveloppeurMiddleware
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
        if(Auth::user() && Developpeur::where('user_id', Auth::user()->id)->exists())
        {
            return $next($request);

        }
        return redirect()->route('login');
        
    }
}
