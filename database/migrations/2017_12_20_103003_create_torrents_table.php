<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTorrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torrents', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->dateTime('publishDate');
            $table->unsignedInteger('size');
            $table->boolean('blacklisted');

            $table->string('commentUrl')->nullable();
            $table->string('downloadUrl')->nullable();
            $table->string('infoUrl')->nullable();

            $table->string('magnetUrl');
            $table->string('infoHash');
            $table->integer('seeders');
            $table->integer('leechers');

            $table->integer('media_item_id')->unsigned();
            $table->foreign('media_item_id')->references('id')->on('media_items');

            $table->integer('quality_id')->unsigned();
            $table->foreign('quality_id')->references('id')->on('qualities');

            $table->integer('indexer_id')->unsigned();
            $table->foreign('indexer_id')->references('id')->on('indexers');

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
        Schema::dropIfExists('torrents');
    }
}
