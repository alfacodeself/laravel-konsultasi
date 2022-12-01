<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psycholog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function psycholog_users()
    {
        return $this->hasMany(PsychologUser::class);
    }
    public function psychological_test_results()
    {
        return $this->hasMany(PsychologicalTestResult::class);
    }
}
