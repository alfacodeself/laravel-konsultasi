<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\Psycholog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PsychologUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        // dd(session('point'));
        return view('user.auth.login');
    }
    public function authenticate(Request $request)
    {
        // dd(session('point'));
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if (Auth::guard('admin')->check()) {
            return back()->with('error', 'Anda telah terdeteksi login sebagai admin! Harap logout terlebih dahulu!');
        }
        try {
            if (!Auth::guard('user')->attempt($credential, true)) {
                return redirect()->route('login')->withErrors([
                    'email' => 'Unknown creential! Please check your credential!'
                ]);
            }

            if (session()->has('point') && session()->has('psycholog')) {
                $psycholog = Psycholog::where('uuid', session('psycholog'))->firstOrFail();
                PsychologUser::create([
                    'uuid' => Str::uuid(),
                    'psycholog_id' => $psycholog->id,
                    'user_id' => Auth::guard('user')->id(),
                    'nilai' => session('point'),
                    'status' => 'belum lunas'
                ]);
                
                session()->forget(['point', 'psycholog', 'warning']);
                return redirect()
                    ->route('user.dashboard')
                    ->with('success', 'Berhasil menyelesaikan tes psikologi ' . $psycholog->judul);
            }
            return redirect()
                ->route('user.dashboard')
                ->with('success', 'Login succesfully, Welcome ' . Auth::guard('user')->user()->nama);
            
        } catch (\Throwable $th) {
            return redirect()->route('login')->withErrors([
                'email' => 'Error! ' . $th->getMessage()
            ]);
        }
    }
}
