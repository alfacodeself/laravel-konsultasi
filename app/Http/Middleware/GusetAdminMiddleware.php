<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GusetAdminMiddleware
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
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard')->with('error', 'Tidak bisa mengunjungi halaman ketika anda sedang login!');
        }
        return $next($request);
    }
}
