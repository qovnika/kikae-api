<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ["product", "transaction", "color", "drawing", "fabric", "location", "logistic"];

    public function product () {
        return $this->belongsTo(Product::class);
    }

    public function transaction () {
        return $this->belongsTo(Transaction::class);
    }

    public function color () {
        return $this->belongsTo(ProductColor::class, "colour");
    }

    public function drawing () {
        return $this->belongsTo(ProductDrawing::class, "drawing");
    }

    public function fabric () {
        return $this->belongsTo(ProductFabric::class, "fabric");
    }

    public function location () {
        return $this->belongsTo(ProductLocation::class, "location");
    }

    public function logistic () {
        return $this->belongsTo(Logistic::class);
    }

}
