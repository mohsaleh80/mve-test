<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //return redirect(RouteServiceProvider::HOME);

                if(Auth::check() && $request->user()->role === 'admin'){
            
                    return redirect()->route('admin.dashboard');
        
                }elseif(Auth::check() && $request->user()->role === 'vendor'){
        
        
                    return redirect()->route('vendor.dashboard');
                }
                elseif(Auth::check() && $request->user()->role === 'user'){
                      
                    return redirect()->route('user.dashboard');
                   // return redirect()->intended(RouteServiceProvider::HOME)->with($notification);
                }
            }
        }

        return $next($request);
    }
}