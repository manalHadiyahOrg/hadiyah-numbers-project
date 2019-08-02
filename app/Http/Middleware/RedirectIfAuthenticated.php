<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
              if (Auth::guard($guard)->check()) {
                return redirect('/GUIAdmin');
              }
              break;
            case 'observer':
              if (Auth::guard($guard)->check()) {
                return redirect('/GUIObserver');
              }
              break;
            case 'superviser':
              if (Auth::guard($guard)->check()) {
                return redirect('/GUISupervisor');
              }
              break;
            case 'it':
            if (Auth::guard($guard)->check()) {
              return redirect('/GUIit');
            }
            break;
          default:
              if (Auth::guard($guard)->check()) {
                  return redirect('/');
              }
              break;
          }
    
        return $next($request);
    }
}
