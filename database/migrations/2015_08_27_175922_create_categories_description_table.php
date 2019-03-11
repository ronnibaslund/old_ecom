<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name', 40);
            $table->string('title_tag', 80);
            $table->longText('desc_tag');
            $table->longText('keywords_tag');
            $table->longText('description');
            $table->string('title');
            $table->integer('language_id');
            $table->timestamps();

            $table->index('category_id');
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
        Schema::drop('categories_description');
    }
}
