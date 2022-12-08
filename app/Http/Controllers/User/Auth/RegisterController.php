<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\Psycholog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PsychologUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register()
    {
        // dd(session('point'));
        return view('user.auth.register');
    }
    public function register_process(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);
        try {
            // dd(session('point'), session('psycholog'), auth('user')->user());
            $user = User::create([
                'uuid' => Str::uuid(),
                'nama' => $request->nama,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => bcrypt($request->password)
            ]);
            Auth::guard('user')->login($user);
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
            return redirect()->route('register')->with([
                'error' => 'Error! ' . $th->getMessage()
            ]);
        }
    }
}
