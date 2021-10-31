<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {

            /*
            user_id (integer, foreign)
            movie_id (integer, foreign)
            rating (integer, 1-5)
            comment (string, max 255, nullable)
            timestamps (created_at, updated_at)*/
            $table->integer("user_id");
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer("movie_id");
            $table->foreign('movie_id')->references('id')->on('movies');

            $table->integer("rating");
            $table->string("comment", 255)->nullable();
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
        Schema::dropIfExists('ratings');
    }
}
