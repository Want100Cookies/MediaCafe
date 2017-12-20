<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('media_item_id')->unsigned();
            $table->foreign('media_item_id')->references('id')->on('media_items');

            $table->integer('quality_id')->unsigned();
            $table->foreign('quality_id')->references('id')->on('qualities');

            $table->string('filename');
            $table->integer('size');

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
        Schema::dropIfExists('files');
    }
}
