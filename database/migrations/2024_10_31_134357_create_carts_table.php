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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("product_id")->constrained("products")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("color_id")->nullable()->constrained("product_colors")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("size_id")->nullable()->constrained("product_sizes")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("location_id")->nullable()->constrained("product_locations")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("drawing_id")->nullable()->constrained("product_drawings")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("fabric_id")->nullable()->constrained("product_fabrics")->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer("units")->default(1);
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
        Schema::dropIfExists('carts');
    }
};
