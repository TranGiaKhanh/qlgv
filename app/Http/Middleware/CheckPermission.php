<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check() && Auth::user()->first_login == config('const.FIRSTLOGIN')) {
            return redirect()->route('homes.showFormChangePassword');
        }

        if (Auth::user()->is_admin){
            return $next($request);
        }

        foreach($roles as $role) 
        {
            if(Auth::user()->role->name == $role)
            {
                return $next($request);
            }
        }
        return redirect('404');
    }
}
