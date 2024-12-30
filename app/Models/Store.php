<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    protected $with = ["user", "category", "product_category", "subscriptions", "videos", "stories", "state", "availability"];

    protected $casts = [
        'views' => 'integer',
    ];

    public function category () {
        return $this->belongsTo(Category::class);
    }
    
    public function product_category () {
        return $this->belongsTo(Category::class);
    }

    public function followers () {
        return $this->hasMany(Follow::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function products () {
        return $this->hasMany(Product::class);
    }

    public function subscriptions () {
        return $this->hasMany(Subscription::class);
    }

    public function state () {
    	return $this->belongsTo(State::class);
    }
    
    public function videos () {
        return $this->hasMany(storevideos::class);
    }

    public function stories () {
        return $this->hasMany(Story::class);
    }
    
    public function ratings () {
    	return $this->hasMany(Storeratings::class);
    }
    
    public function transactions () {
    	return $this->belongsTo(Transaction::class);
    }

    public function availability () {
        return $this->hasMany(ArtistAvailable::class);
    }
}
