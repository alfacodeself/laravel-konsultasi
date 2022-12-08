<?php

namespace App\Http\Middleware;

use App\Models\Schedule;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class KonselingChatMiddleware
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
        if (!auth('admin')->check() && !auth('user')->check()) {
            return back()->with('error', 'Harap login terlebih dahulu!');
        }
        if (Carbon::now()->format('Y-m-d H:i:s') < Carbon::parse($request->schedule->jadwal_konseling)->format('Y-m-d H:i:s')) {
            return back()->with('error', 'Jadwal konseling belum dimulai');
        }
        if ($request->schedule->status_pembayaran != 'lunas') {
            return back()->with('error', 'Status pembayaran belum lunas!');   
        }
        if ($request->schedule->status == 'proses') {
            return back()->with('warning', 'Harap menunggu persetujuan admin!');   
        }
        elseif ($request->schedule->status == 'batal') {
            return back()->with('error', 'Anda sudah membatalkan jadwal!');   
        }
        return $next($request);  
    }
}
