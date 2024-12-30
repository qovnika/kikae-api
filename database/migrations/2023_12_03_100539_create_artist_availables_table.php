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
        Schema::create('artist_availables', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid("store_id")->constrained("stores")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("product_id")->constrained("products")->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime("dated");
            $table->boolean("available")->default(true);
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
        Schema::dropIfExists('artist_availables');
    }
};
