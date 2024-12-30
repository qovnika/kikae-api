<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class storevideos extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ["products"];

    public function products () {
        return $this->hasMany(RunwayProduct::class, "runway_id");
    }
}
