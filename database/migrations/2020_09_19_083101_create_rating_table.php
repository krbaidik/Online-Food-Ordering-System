<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->id();
            $table->Biginteger('u_id')->unsigned();
            $table->foreign('u_id')->references('id')->on('users')->onDelete('cascade');
            $table->Biginteger('f_id')->unsigned();
            $table->foreign('f_id')->references('id')->on('foods')->onDelete('cascade');
            $table->integer('rating_value');
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
        Schema::dropIfExists('rating');
    }
}
