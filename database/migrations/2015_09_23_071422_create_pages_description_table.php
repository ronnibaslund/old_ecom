<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->string('name');
            $table->longText('content');
            $table->string('url');
            $table->integer('language_id');

            $table->timestamps();

            $table->index('page_id');
            $table->index('language_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages_description');
    }
}
