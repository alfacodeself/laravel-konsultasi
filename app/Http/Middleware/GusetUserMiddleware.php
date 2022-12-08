<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GusetUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('user')->check()) {
            return redirect()->route('user.dashboard')->with('error', 'Tidak bisa mengunjungi halaman ketika anda sedang login!');
        }
        return $next($request);
    }
}
