<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsDescriptionTable extends Migration
{

//coupon_name VARCHAR(32) DEFAULT '' NOT NULL,
//coupon_description LONGTEXT


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coupon_id');
            $table->integer('language_id');
            $table->string('name', 40);
            $table->longText('description');

            $table->timestamps();

            $table->index('coupon_id');
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
        Schema::drop('coupons_description');
    }
}
