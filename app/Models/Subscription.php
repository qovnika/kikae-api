<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ["plan"];

    public function plan () {
        return $this->belongsTo(Plans::class, "plan_id");
    }
}
