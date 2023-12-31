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
        Schema::create('all_sales', function (Blueprint $table) {
            $table->id();
            $table->text('Account_SaleID');
            $table->text('ProductID');
            $table->integer('Quantity');
            $table->decimal('Amount');
            $table->text('paymentMethod');
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
        Schema::dropIfExists('all_sales');
    }
};
