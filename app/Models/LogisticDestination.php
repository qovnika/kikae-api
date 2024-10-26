<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogisticDestination extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    protected $with = ["state"];
    
    public function state () {
    	return $this->belongsTo(State::class);
    }
}
