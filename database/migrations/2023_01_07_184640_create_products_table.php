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
            $table->integer("units");
            $table->foreignId("category_id")->constrained("categories")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid("store_id")->constrained("stores")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_category_id')->constrained("product_categories")->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean("bespoke")->default(false);
            $table->boolean("note")->default(true);
            $table->boolean("top_height")->default(true);
            $table->boolean("shoulder_length")->default(true);
            $table->boolean("neck_length")->default(true);
            $table->boolean("arm_width")->default(true);
            $table->boolean("belly_length")->default(true);
            $table->boolean("waist_length")->default(true);
            $table->boolean("bottom_length")->default(true);
            $table->boolean("thigh")->default(true);
            $table->boolean("ankle_width")->default(true);
            $table->boolean("size")->default(true);
            $table->boolean("fabric")->default(true);
            $table->float("rating")->nullable();
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
