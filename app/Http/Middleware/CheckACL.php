<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class CheckACL
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        if (Gate::denies($permission)) {
            if ($request->routeIs('admin.*')) {
                return redirect(route('admin.index'))->with('alert-fail','Không thể truy cập!');;
            }
        }
        return $next($request);
    }
}
