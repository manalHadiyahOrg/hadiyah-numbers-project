<?php

namespace App\Http\Middleware;

use Closure;

class forms
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
        if((strcasecmp( session()->get('jop'),"مشرف ميداني")==0)){
            return $next($request);
        }
        else     
          return redirect('/');
    }
}
