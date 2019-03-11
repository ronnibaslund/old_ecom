<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsEmailTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons_email_track', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coupon_id');
            $table->integer('customer_id');
            $table->string('name');
            $table->string('emailed_to');

            $table->timestamps();

            $table->index('coupon_id');
            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupons_email_track');
    }
}
