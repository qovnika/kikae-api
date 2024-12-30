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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->float("old_price")->nullable();
            $table->float("price");
            $table->string("name");
            $table->text("description")->nullable();
            $table->integer("units")->nullable();
            $table->foreignId("category_id")->nullable()->constrained("categories")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid("store_id")->constrained("stores")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_category_id')->nullable()->constrained("product_categories")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("state_id")->nullable()->constrained("states")->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean("bespoke")->default(false);
            $table->string("size")->nullable();
            $table->string("fabric")->nullable();
            $table->float("rating")->nullable();
            $table->string("offer")->nullable();
            $table->boolean("made_in_nigeria")->default(false);
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
        Schema::dropIfExists('products');
    }
};
