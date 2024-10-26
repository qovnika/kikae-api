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
            $table->string("size")->nullable();
            $table->foreignId("colour")->nullable()->constrained("product_colors")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("drawing")->nullable()->constrained("product_drawings")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("fabric")->nullable()->constrained("product_fabrics")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("location")->nullable()->constrained("product_locations")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("logistic_id")->nullable()->constrained("logistics")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("status")->default("Order placed");
            $table->boolean("settled")->default(false);
            $table->float("latitude")->nullable();
            $table->float("longitude")->nullable();
            $table->foreignId("transaction_id")->constrained("transactions")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("delivery_address")->nullable();
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
