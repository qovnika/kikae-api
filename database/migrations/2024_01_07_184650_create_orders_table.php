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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained("products")->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer("units");
            $table->string("name")->nullable();
            $table->float('price')->nullable();
            $table->text("note")->nullable();
            $table->foreignId("size")->nullable()->constrained("product_sizes")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("colour")->nullable()->constrained("product_colors")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("drawing")->nullable()->constrained("product_drawings")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("fabric")->nullable()->constrained("product_fabrics")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("location")->nullable()->constrained("product_locations")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("logistic_id")->nullable()->constrained("logistics")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("top_length")->nullable();
            $table->string("shoulder_length")->nullable();
            $table->string("neck_length")->nullable();
            $table->string("sleeves")->nullable();
            $table->string("biceps")->nullable();
            $table->string("armors")->nullable();
            $table->string("waist_length")->nullable();
            $table->string("bottom_length")->nullable();
            $table->string("thigh")->nullable();
            $table->string("ankle_width")->nullable();
            $table->string("status")->default("Order placed");
            $table->boolean("settled")->default(false);
            $table->float("latitude")->nullable();
            $table->float("longitude")->nullable();
            $table->foreignId("transaction_id")->constrained("transactions")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("delivery_address")->nullable();
            $table->foreignId("available_id")->nullable()->constrained("artist_availables")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("area_id")->nullable()->constrained("logistic_destinations")->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('orders');
    }
};
