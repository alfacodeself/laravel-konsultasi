<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Pricing;
use App\Models\Question;
use App\Models\Schedule;
use App\Models\Psycholog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $tes = Psycholog::count();
        $soal = Question::count();
        $konsel = Schedule::groupBy('user_id')->count();
        $jadwal = Schedule::count();
        $trx = Transaction::where('status', 'paid')->count();
        $jumlah = Transaction::where('status', 'paid')->sum('total_amount');
        $paket = Pricing::count();
        $paketAkt = Pricing::where('status', 'aktif')->count();

        
        $jdw = Schedule::whereDate('jadwal_konseling', Carbon::now()->format('Y-m-d'))->where('status', 'terima')->get();
        // dd($jdw);
        return view('admin.dashboard', compact('tes', 'soal', 'konsel', 'jadwal', 'trx', 'jumlah', 'paket', 'paketAkt', 'jdw'));
    }
}
