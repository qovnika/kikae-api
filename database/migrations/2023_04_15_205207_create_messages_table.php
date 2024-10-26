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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sender_id")->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->text("body")->nullable();
            $table->foreignId("recepient_id")->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("type")->nullable();
            $table->boolean("read")->default(false);
            $table->boolean("starred")->default(false);
            $table->boolean("muted")->default(false);
            $table->boolean("archived")->default(false);
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
        Schema::dropIfExists('messages');
    }
};
