<?php

namespace App\Http\Middleware;

use Closure;

class CheckCompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! auth()->user()->profile_completed_at)
        {
            return redirect()->route('complete.profile.index');
        }

        return $next($request);
    }
}
