<?php

namespace App\Http\Controllers\User;

use App\Models\Pricing;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\TripayController;

class JadwalUserController extends Controller
{
    public function index()
    {
        $schedules = Schedule::latest()->get();
        // dd($schedules);
        return view('user.konseling.index', compact('schedules'));
    }
    public function create(Pricing $pricing)
    {
        $pricing->fitur_paket = explode('|', $pricing->fitur_paket);
        // dd($pricing);
        return view('user.konseling.create', compact('pricing'));
    }
    public function store(Pricing $pricing, Request $request)
    {
        $request->validate([
            'jadwal' => 'required'
        ]);
        try {
            Schedule::create([
                'uuid' => Str::uuid(),
                'user_id' => auth('user')->id(),
                'pricing_id' => $pricing->id,
                'jadwal_konseling' => $request->jadwal
            ]);
            return redirect()->route('user.konseling.index')->with('success', 'Berhasil membuat jadwal! Silakan melakukan pembayaran!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function checkout(Schedule $schedule, TripayController $tripay)
    {
        if ($schedule->user->id != auth('user')->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
        }
        if ($schedule->status_pembayaran != "belum lunas") {
            return redirect()->back()->with('warning', 'Konseling telah dilunasi.');
        };
        if ($schedule->status != 'proses') {
            return redirect()->back()->with('error', 'Status jadwal tidak memenuhi!');
            
        }
        $schedule->pricing->fitur_paket = explode('|', $schedule->pricing->fitur_paket);
        // dd($schedule->pricing->fitur_paket);
        return view('user.konseling.checkout', [
            'schedule' => $schedule,
            'payments' => $tripay->getPaymentChannels() 
        ]);
    }
    public function cancel(Schedule $schedule)
    {
        if ($schedule->status_pembayaran != 'belum lunas') {
            return back()->with('error', 'Pembayaran telah dilakukan. Tidak dapat membatalkan jadwal!');
        }
        try {
            $schedule->update(['status' => 'batal']);
            return redirect()->route('user.konseling.index')->with('success', 'Berhasil membatalkan jadwal!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
