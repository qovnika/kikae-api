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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->foreignUuid("store_id")->constrained("stores")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("event_type")->constrained("event_types")->cascadeOnUpdate()->cascadeOnDelete();
            $table->date("dated");
            $table->time("timed");
            $table->string("venue")->nullable();
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
        Schema::dropIfExists('events');
    }
};
