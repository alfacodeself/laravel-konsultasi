<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function pricing()
    {
        return $this->belongsTo(Pricing::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
