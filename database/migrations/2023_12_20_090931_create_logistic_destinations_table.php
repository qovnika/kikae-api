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
        Schema::create('logistic_destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("logistic_id")->constrained("logistics")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("state_id")->constrained("states")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("area")->nullable();
            $table->float("cost")->nullable();
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
        Schema::dropIfExists('logistic_destinations');
    }
};
