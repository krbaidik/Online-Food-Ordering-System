<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendation', function (Blueprint $table) {
            $table->id();
            $table->Biginteger('fo_id')->unsigned();
            $table->foreign('fo_id')->references('id')->on('foods')->onDelete('cascade');
            $table->Biginteger('mean_rating');

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
        Schema::dropIfExists('recommendation');
    }
}
