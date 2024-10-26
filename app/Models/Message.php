<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ["sender", "recepient"];

    function sender () {
        return $this->belongsTo(User::class);
    }

    function recepient () {
        return $this->belongsTo(User::class);
    }

}
