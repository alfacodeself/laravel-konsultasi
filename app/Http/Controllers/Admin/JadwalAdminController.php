<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class JadwalAdminController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('status_pembayaran', 'lunas')->get();
        return view('admin.konseling.index', compact('schedules'));
    }
    public function store(Schedule $schedule, Request $request)
    {
        if ($schedule->status_pembayaran != 'lunas') {
            return back()->with('error', 'Belum melakukan pembayaran!');
        }
        elseif ($schedule->status != 'proses') {
            return back()->with('error', 'Status tidak memenuhi!');
        }
        try {
            $data = ['status' => 'terima'];
            if ($request->has('jadwal')) {
                $data['jadwal_konseling'] = $request->jadwal;
            }
            $schedule->update($data);
            return redirect()->route('admin.konsultasi.index')->with('success', 'Berhasil menerima jadwal konseling');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function finish(Schedule $schedule)
    {
        if ($schedule->status_pembayaran != 'lunas') {
            return back()->with('error', 'Belum melakukan pembayaran!');
        }
        elseif ($schedule->status != 'terima') {
            return back()->with('error', 'Status tidak memenuhi!');
        }
        try {
            $schedule->update(['status' => 'selesai']);
            return redirect()->route('admin.konsultasi.index')->with('success', 'Berhasil menyelesaikan jadwal konseling');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
