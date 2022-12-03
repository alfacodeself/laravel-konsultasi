<?php

namespace App\Http\Controllers\User;

use App\Models\Pricing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardUserController extends Controller
{
    public function __invoke(Request $request)
    {
        $pricings = Pricing::get()->map(function($paket){
            $paket->fitur_paket = explode('|', $paket->fitur_paket);
            return $paket;
        });
        // dd($pricings);
        return view('user.dashboard', compact('pricings'));
    }
}
