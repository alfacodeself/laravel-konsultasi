<?php

namespace App\Http\Controllers\User;

use App\Models\Psycholog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PsychologUser;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\TripayController;
use Illuminate\Support\Facades\Auth;

class PsychologUserController extends Controller
{
    public function index()
    {
        $psychologs = Psycholog::with('psycholog_users.user')->whereRelation( 'psycholog_users','user_id', Auth::guard('user')->id())->get();
        // dd($psychologs);
        return view('user.psikolog.index', compact('psychologs'));
    }
    public function show(Psycholog $psycholog)
    {
        $psycholog_users = PsychologUser::where('psycholog_id', $psycholog->id)->where('user_id', Auth::guard('user')->id())->get();
        return view('user.psikolog.show', compact('psycholog_users'));
        // Str::limit()
    }
    public function checkout(Psycholog $psycholog, PsychologUser $psycholog_user)
    {
        if ($psycholog_user->user->id != auth('user')->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
        }
        if ($psycholog_user->status != "belum lunas") {
            return redirect()->back()->with('warning', 'Tes Psikolog telah dilunasi.');
        }
        $tripay = new TripayController;
        return view('user.psikolog.checkout', [
            'psycholog' => $psycholog,
            'psycholog_user' => $psycholog_user,
            'payments' => $tripay->getPaymentChannels() 
        ]);
    }
}
