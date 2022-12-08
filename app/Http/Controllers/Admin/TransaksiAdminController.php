<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PsychologUser;
use App\Http\Controllers\Controller;

class TransaksiAdminController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('status', 'paid')->latest()->paginate(10);
        // dd($transactions[0]->product);
        return view('admin.transaksi.index', compact('transactions'));
    }
    public function show($reference)
    {
        $transaction = Transaction::where('reference', $reference)->firstOrFail();
        $transaction->user = $transaction->transactionable->user;
        if ($transaction->transactionable instanceof PsychologUser) {
            $transaction->item = $transaction->transactionable->psycholog->judul;
            $transaction->type = 'PSIKOLOG';
        }
        elseif($transaction->transactionable instanceof Schedule){
            $transaction->item = $transaction->transactionable->pricing->nama_paket;
            $transaction->type = 'KONSELING';
        }
        return view('user.transaksi.detail', compact('transaction'));
    }
}
