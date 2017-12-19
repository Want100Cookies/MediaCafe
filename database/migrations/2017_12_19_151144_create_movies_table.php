<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->dateTime('released_on');
            $table->string('genre')->nullable();
            $table->string('moviedbid')->nullable();
            $table->string('imdbid')->nullable();

//            $table->integer('quality_id')->unsigned();
//            $table->foreign('quality_id')->references('id')->on('qualities');

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
