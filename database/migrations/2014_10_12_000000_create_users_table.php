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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('onames')->nullable();
            $table->string('lname');
            $table->string('email')->unique();
            $table->date("dob")->nullable();
            $table->string("phone")->nullable();
            $table->text("address")->nullable();
            $table->foreignId("usertype_id")->constrained("usertypes")->cascadeOnUpdate()->cascadeOnDelete();
            $table->text("profilePic")->nullable();
            $table->boolean("isVendor")->nullable();
            $table->boolean("isAdmin")->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string("code")->nullable();
            $table->boolean("isLogged")->default(false);
            $table->boolean("status")->default(true);
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->foreignId("state_id")->nullable()->constrained("states")->cascadeOnUpdate()->cascadeOnDelete();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
