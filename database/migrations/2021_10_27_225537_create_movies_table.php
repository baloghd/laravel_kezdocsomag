<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            /*
                id
                title (string)
                director (string)
                description (text)
                year (integer)
                length (integer, másodpercekben mérjük)
                image (string, nullable)
                ratings_enabled (boolean, default: true)
                timestamps (created_at, updated_at, később deleted_at)
            */
            $table->string("title");
            $table->string("director");
            $table->text("description");
            $table->integer("year");
            $table->integer("length");
            $table->string("image")->default("https://via.placeholder.com/300x400?text=Placeholder+filmposzter");
            $table->boolean('ratings_enabled')->default(true);
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
        Schema::dropIfExists('movies');
    }
}
