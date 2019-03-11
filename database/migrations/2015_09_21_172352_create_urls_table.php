<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->increments('id');
            $table->text('url');
            $table->text('new_url');
            $table->string('type'); //Page, Product, Category etc...
            $table->integer('content_id'); // forgin ID
            $table->string('controller');
            $table->string('controller_method');
            $table->string('method'); // GET, PUT, POST, DELETE
            $table->string('action'); // Normal, 301, etc...

            $table->timestamps();

            $table->index('content_id');
            $table->index('type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('urls');
    }
}