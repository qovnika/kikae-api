<?php

namespace App\Models;

use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ["media", "register"];

    public function media () {
        return $this->hasMany(EventMedia::class);
    }
    
    public function store () {
    	return $this->belongsTo(Store::class);
    }
    
    public function register () {
    	return $this->hasMany(EventRegister::class);
    }
}
