<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\TripayController;
use App\Models\PsychologUser;
use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionUserController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('transactionable')
            ->whereHas('schedules', fn ($q) => $q->where('user_id', auth('user')->id()))
            ->orWhereHas('psycholog_users', fn ($q) => $q->where('user_id', auth('user')->id()))
            ->orderByRaw("FIELD(status, 'unpaid', 'paid') ASC")
            ->get();
        // dd($transactions);
        return view('user.transaksi.index', compact('transactions'));
    }
    public function storePsycholog(Request $request, PsychologUser $psycholog_user)
    {
        if ($psycholog_user->user->id != auth('user')->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
        }
        if ($psycholog_user->transactions->where('status', 'unpaid')->count() != 0) {
            return redirect()->back()->with('error', 'Anda memiliki transaksi yang sedang berjalan pada hasil tes psikolog ini!');
        }
        $tripay = new TripayController;
        $transaction = $tripay->requestTransaction($request->method, $psycholog_user);

        // Insert to Database
        $psycholog_user->transactions()->create([
            'user_id' => $psycholog_user->user->id,
            'reference' => $transaction->reference,
            'merchant_ref' => $transaction->merchant_ref,
            'total_amount' => $transaction->amount,
            'status' => $transaction->status,
        ]);
        
        return redirect()->route('user.transaksi.show', $transaction->reference);
    }
    public function storeSchedule(Request $request, Schedule $schedule)
    {
        if ($schedule->user->id != auth('user')->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
        }
        if ($schedule->transactions->where('status', 'unpaid')->count() != 0) {
            return redirect()->back()->with('error', 'Anda memiliki transaksi yang sedang berjalan pada jadwal ini!');
        }
        $tripay = new TripayController;
        $transaction = $tripay->requestTransactionKonseling($request->method, $schedule);

        // Insert to Database
        $schedule->transactions()->create([
            'user_id' => $schedule->user->id,
            'reference' => $transaction->reference,
            'merchant_ref' => $transaction->merchant_ref,
            'total_amount' => $transaction->amount,
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
    public function detail($reference)
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
