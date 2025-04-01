<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class AdminPanel
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
        if(!Gate::allows('adminpanel')){
            $refirect = redirect()->intended('/');
            return $refirect;
            //echo"Разрешено!";
        }
        return $next($request);
    }
}
