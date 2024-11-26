<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            $notification = array(
                'title' => 'Sorry!',
                'message' => 'You need to login first',
                'alert-type' => 'info',
            );

            return redirect()->route('admin.authenticate')->with($notification);
        }
        return $next($request);
    }
}
