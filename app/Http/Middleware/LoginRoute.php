<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LoginRoute
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
        $check=Auth::check();
        $auth=in_array(Route::getCurrentRoute()->getPrefix(),['/register','/login']);

        if ($auth?!$check:$check)return $next($request);
        return redirect()->route($auth?'profile':'login');
    }
}
