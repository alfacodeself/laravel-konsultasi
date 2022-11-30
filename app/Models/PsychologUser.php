<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsychologUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function psycholog()
    {
        return $this->belongsTo(Psycholog::class);
    }
}
