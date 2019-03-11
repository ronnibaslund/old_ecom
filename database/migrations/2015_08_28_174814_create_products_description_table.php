<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('language_id');
            $table->string('name', 70)->default('');
            $table->longText('description');
            $table->string('url');
            $table->integer('viewed')->default(0);
            $table->longText('head_desc_tag');
            $table->longText('head_keywords_tag');

            $table->timestamps();

            $table->index('product_id');
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
        Schema::drop('products_description');
    }
}
