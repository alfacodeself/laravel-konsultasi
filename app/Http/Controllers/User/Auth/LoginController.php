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
        return view('user.auth.login');
    }
    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        try {
            if (!Auth::guard('user')->attempt($credential, true)) {
                return redirect()->route('login')->withErrors([
                    'email' => 'Unknown creential! Please check your credential!'
                ]);
            }
            if ($request->has('point') && $request->has('psycholog')) {
                $psycholog = Psycholog::where('uuid', $request->psycholog)->firstOrFail();
                PsychologUser::create([
                    'uuid' => Str::uuid(),
                    'psycholog_id' => $psycholog->id,
                    'user_id' => Auth::guard('user')->id(),
                    'nilai' => $request->point,
                    'status' => 'belum lunas'
                ]);
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
