<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('u_id');
            $table->unsignedBigInteger('f_id');
            $table->integer('order_no');
            $table->string('order_status')->nullable();
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('shipping_charge')->nullable();
            $table->unsignedBigInteger('total_price');
            $table->string('order_note')->nullable();
            $table->foreign('u_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('f_id')->references('id')->on('foods')->onDelete('cascade');
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
