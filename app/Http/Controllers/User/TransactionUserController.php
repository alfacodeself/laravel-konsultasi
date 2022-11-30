<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\TripayController;
use App\Models\PsychologUser;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionUserController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderByRaw("FIELD(status, 'unpaid', 'paid') ASC")->get();
        // dd($transactions[0]->product);
        return view('user.transaksi.index', compact('transactions'));
    }
    public function store(Request $request, PsychologUser $psycholog_user)
    {
        if ($psycholog_user->user->id != auth('user')->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
        }
        $tripay = new TripayController;
        $transaction = $tripay->requestTransaction($request->method, $psycholog_user);

        // Insert to Database
        Transaction::create([
            'user_id' => $psycholog_user->user->id,
            'barang_id' => $psycholog_user->psycholog->id,
            'reference' => $transaction->reference,
            'merchant_ref' => $transaction->merchant_ref,
            'total_amount' => $transaction->amount,
            'type' => $request->type,
            'status' => $transaction->status,
        ]);
        return redirect()->route('user.transaksi.show', $transaction->reference);
    }
    public function show($reference)
    {
        $tripay = new TripayController;
        $detail = $tripay->detailTransaction($reference);
        return view('user.transaksi.show', compact('detail'));
    }
}
