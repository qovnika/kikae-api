<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ["user"];

    public function orders () {
        return $this->hasMany(Order::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
