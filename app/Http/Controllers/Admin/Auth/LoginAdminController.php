<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if (Auth::guard('user')->check()) {
            return back()->with('error', 'Anda telah terdeteksi login sebagai user! Harap logout terlebih dahulu!');
        }
        try {
            if (!Auth::guard('admin')->attempt($credential, true)) {
                return redirect()->route('admin.login')->withErrors([
                    'email' => 'Unknown creential! Please check your credential!'
                ]);
            }
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login succesfully, Welcome ' . Auth::guard('admin')->user()->nama);
        } catch (\Throwable $th) {
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Error! ' . $th->getMessage()
            ]);
        }
    }
}
