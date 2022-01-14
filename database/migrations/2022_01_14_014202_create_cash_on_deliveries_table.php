<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashOnDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_on_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rider_id');
            $table->foreignId('delivery_id');
            $table->float('amount');
            $table->enum('type',['online','on-hand'])->nullable();
            $table->enum('online_status',['pending','received','failed'])->default('pending');
            $table->foreignId('staff_id')->nullable();
            $table->enum('verified',['yes','no'])->default('no');
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
        Schema::dropIfExists('cash_on_deliveries');
    }
}
