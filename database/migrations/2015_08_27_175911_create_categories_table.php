<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default('0');
            $table->integer('parent_id')->index();
            $table->string('path', 255)->nullable()->index();
            $table->boolean('categories_featured')->default('0');
            $table->date('categories_featured_until');
            $table->tinyInteger('status')->default('0');
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
        Schema::drop('categories');
    }
}
