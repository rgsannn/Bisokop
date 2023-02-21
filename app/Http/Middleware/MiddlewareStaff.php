<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MiddlewareStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     if(!auth()->guard('staff')->check()) {
    //         return redirect(route('staff.login'));
    //     }
        
    //     return $next($request);
    // }
    // public function handle(Request $request, Closure $next)
    // {
    //     $user = auth('staff')->user();
    //     if(!auth()->guard('staff')->check()) {
    //         return redirect(route('staff.login'));
    //     }
        
    //     if ($user && ($user->role == 'Admin' || $user->role == 'Cashier')) {
    //         return $next($request);
    //     }

    //     abort(403, 'Unauthorized action.');
        
    // }

    public function handle(Request $request, Closure $next, $role = '')
    {
        $user = auth()->guard('staff');
        if(!$user->check()) {
            return redirect(route('staff.login'));
        }

        if (!empty($role) && $user->user()->role != $role) {
            return abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
