<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $casts = [
        'bespoke' => 'boolean',
    ];

    protected $with = ["shop", "media", "product_category", "category", "colours", "fabrics", "drawings", "ratings", "likes", "sizes", "locations"];

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function product_category () {
        return $this->belongsTo(ProductCategory::class);
    }

    public function shop () {
        return $this->belongsTo(Store::class, "store_id");
    }

    public function orders () {
        return $this->belongsToMany(Order::class);
    }

    public function media () {
        return $this->hasMany(Media::class);
    }

    public function colours () {
        return $this->hasMany(ProductColor::class);
    }

    public function fabrics () {
        return $this->hasMany(ProductFabric::class);
    }

    public function drawings () {
        return $this->hasMany(ProductDrawing::class);
    }

    public function ratings () {
        return $this->hasMany(Productratings::class);
    }

    public function likes () {
        return $this->hasMany(Productlikes::class);
    }

    public function sizes () {
        return $this->hasMany(ProductSize::class);
    }

    public function locations () {
        return $this->hasMany(ProductLocation::class);
    }
}
