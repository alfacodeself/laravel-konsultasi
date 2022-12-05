<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function chatable()
    {
        return $this->morphTo();
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
