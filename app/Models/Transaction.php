<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $append = ['product'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function psycholog()
    {
        return $this->belongsTo(Psycholog::class, 'barang_id', 'id');
    }
    public function getProductAttribute()
    {
        if ($this->type == 'psikolog') {
            return $this->psycholog;
        }
        elseif ($this->type == 'konseling') {
            return 'konseling';
        }
    }
}
