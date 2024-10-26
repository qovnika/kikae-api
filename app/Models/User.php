<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guarded = ["id"];

    protected $with = ["usertype", "followings"];

    public function usertype () {
        return $this->belongsTo(Usertype::class);
    }

    public function stores () {
        return $this->hasMany(Store::class);
    }

    public function followings () {
        return $this->hasMany(Follow::class);
    }
}
