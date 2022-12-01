<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsychologicalTestResult extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function psycholog()
    {
        return $this->belongsTo(Psycholog::class);
    }
}
