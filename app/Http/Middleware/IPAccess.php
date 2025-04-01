<?php

namespace App\Http\Middleware;
use Closure;
use DB;

class IPAccess
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
        $settings = DB::table('settings')->where('id', 1)->first();
        $ipopen = $settings->name;
        $iplist = $settings->data;
        if($ipopen  > 0){
            $iplists = explode(',', $iplist);
            if(!in_array($request->ip(), $iplists)){
                abort(403, 'Access denided.');
            }
        }

        return $next($request);

    }
}
