<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $guarded = [];

    public function transactionable()
    {
        return $this->morphTo();
    }
    public function schedules()
    {
        return $this->belongsTo(Schedule::class, 'transactionable_id')->whereTransactionableType(Schedule::class);
    }
    public function psycholog_users()
    {
        return $this->belongsTo(PsychologUser::class, 'transactionable_id')->whereTransactionableType(PsychologUser::class);
    }
}
