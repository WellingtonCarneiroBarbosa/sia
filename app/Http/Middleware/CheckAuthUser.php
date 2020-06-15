<?php

namespace App\Http\Middleware;

use Closure, Lang;

class CheckAuthUser
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
        $auth_user_id = Auth()->user()->id;
        
        $id = $request->id;

        if((int) $id === $auth_user_id)
        {
            return redirect()->route('users.index')->with(['error' => Lang::get('You cannot perform this action')]);
        }

        return $next($request);
    }
}
