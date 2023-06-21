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
        Schema::create('refill_requests', function (Blueprint $table) {
            $table->id();
            $table->text('Reseller_ID');
            $table->integer('NumberOfGallon');
            $table->double('RefillCost');
            $table->double('RefillShipFee');
            $table->double('TotalCost');
            $table->text('status');
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
        Schema::dropIfExists('refill_requests');
    }
};
