<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('implementation');
            $table->string('meta_id');

            $table->integer('media_item_id')->unsigned();
            $table->foreign('media_item_id')->references('id')->on('media_items');

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
        Schema::dropIfExists('meta_sources');
    }
}
