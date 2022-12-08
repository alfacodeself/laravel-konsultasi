<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Pricing;
use App\Models\Psycholog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PsychologUser;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $psychologs = Psycholog::where('status', 'aktif')->get();
        $pricings = Pricing::where('status', 'aktif')->get()->map(function($pricing){
            $pricing->fitur_paket = explode('|', $pricing->fitur_paket);
            return $pricing;
        });
        return view('welcome', compact('psychologs', 'pricings'));
    }
    public function psycholog(Psycholog $psycholog)
    {
        return view('psikologi.index', compact('psycholog'));
    }
    public function show(Psycholog $psycholog)
    {
        return view('psikologi.show', compact('psycholog'));
    }
    public function store(Request $request, Psycholog $psycholog)
    {
        if (!$request->has('jawaban')) {
            return back()->withErrors(['jawaban' => 'Jawaban tidak boleh kosong']);
        }
        if (count($request->jawaban) < $psycholog->questions->count()) {
            return back()->withErrors(['jawaban' => 'Harap isi semua pertanyaan']);
        }
        try {
            $totalPoint = Answer::whereIn('uuid', $request->jawaban)->sum('poin');
            if (!auth('user')->check()) {
                session()->put(['point' => $totalPoint, 'psycholog' => $psycholog->uuid, 'warning' => 'Silakan login atau register untuk melihat hasil tes psikologi']);
                return redirect()->route('login');
            }
            else {
                PsychologUser::create([
                    'uuid' => Str::uuid(),
                    'psycholog_id' => $psycholog->id,
                    'user_id' => Auth::guard('user')->id(),
                    'nilai' => $totalPoint,
                    'status' => 'belum lunas'
                ]);
                return redirect()->route('user.dashboard')->with('success', 'Berhasil menyelesaikan tes psikologi ' . $psycholog->judul);
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
