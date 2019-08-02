<?php

namespace App\Http\Middleware;
use Session;
use Closure;

class edit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {    if(strcasecmp( session()->get('jop'),"رئيس برامج")==0){
        return $next($request);
    }
        else if((strcasecmp( session()->get('jop'),"رئيس برنامج")==0)){
            return $next($request);
        }
            
        return redirect('/');
    }
}
