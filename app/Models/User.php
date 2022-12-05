<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function psycholog_users()
    {
        return $this->hasMany(PsychologUser::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    public function chats()
    {
        return $this->morphMany(Chat::class, 'chatable');
    }
}
