<?php

namespace App\Http\Controllers\User;

use App\Models\Pricing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardUserController extends Controller
{
    public function __invoke(Request $request)
    {
        $pricings = Pricing::get()->map(function($paket){
            $paket->fitur_paket = explode('|', $paket->fitur_paket);
            return $paket;
        });
        $tests = auth('user')->user()->psycholog_users->count();
        $schedules = auth('user')->user()->schedules->count();
        $trx1 = 0;
        $jml = 0;
        foreach (auth('user')->user()->schedules->where('status_pembayaran', 'lunas') as $schedule) {
            $trx1 += $schedule->transactions->count();
            $jml += $schedule->transactions->sum('total_amount');
        }
        foreach (auth('user')->user()->psycholog_users->where('status', 'lunas') as $konsel) {
            $trx1 += $konsel->transactions->count();
            $jml += $konsel->transactions->sum('total_amount');
        }
        $jadwal = Schedule::whereDate('jadwal_konseling', Carbon::now()->format('Y-m-d'))->where('status', 'terima')->get();
        // dd($jadwal);
        return view('user.dashboard', compact('pricings', 'tests', 'schedules', 'trx1', 'jml', 'jadwal'));
    }
}
