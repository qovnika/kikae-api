<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $with = ["destinations"];

	public function destinations () {
		return $this->belongsTo(LogisticDestination::class, "id", "logistic_id");
	}
    
}
