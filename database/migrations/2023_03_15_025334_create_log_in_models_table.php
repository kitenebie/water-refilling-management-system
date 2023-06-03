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
        Schema::create('log_in_models', function (Blueprint $table) {
            $table->id();
            $table->text('reseller_id');
            $table->text('firstname');
            $table->text('lastname');
            $table->text('Birthday');
            $table->text('address');
            $table->text('contact');
            $table->text('email');
            $table->text('password');
            $table->text('user_authe');
            $table->text('Status');
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
        Schema::dropIfExists('log_in_models');
    }
};
