<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runway_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("runway_id")->constrained("storevideos")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("product_id")->constrained("products")->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('runway_products');
    }
};
