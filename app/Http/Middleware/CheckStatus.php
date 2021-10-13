<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
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
        if(Auth::check() && !Auth::user()->status){
            Auth::logout();
            if ($request->routeIs('admin.*')) {
                return redirect(route('admin.login'))->with('alert-fail', 'Tài khoản đã bị khóa');
            }
            return redirect(route('login'))->with('alert-fail', 'Tài khoản đã bị khóa');
        }
        return $next($request);
    }
}
