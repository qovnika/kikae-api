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
        Schema::create('stores', function (Blueprint $table) {
            $table->uuid("id");
            $table->string("hash")->nullable();
            $table->string("name");
            $table->string("email")->nullable();
            $table->text("address")->nullable();
            $table->string("phone")->nullable();
            $table->text("description")->nullable();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->text("logo")->nullable();
            $table->text("primary_media")->nullable();
            $table->string("position")->nullable();
            $table->foreignId("category_id")->constrained("categories")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_category_id')->constrained("product_categories")->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer("rating")->nullable();
            $table->text("background_image")->nullable();
            $table->text("sound")->nullable();
            $table->string("link")->nullable();
            $table->integer("volume")->default(100);
            $table->integer("views")->default(0);
            $table->string("animation")->nullable();
            $table->float("balance")->default(0.00);
            $table->foreignId("state_id")->constrained("states")->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->primary("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
