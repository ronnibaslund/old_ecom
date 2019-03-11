<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsRedeemTrackTable extends Migration
{
//

//redeem_ip VARCHAR(32) DEFAULT '' NOT NULL,
//order_id INT DEFAULT 0 NOT NULL

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons_redeem_track', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coupon_id');
            $table->integer('customer_id');
            $table->integer('order_id');
            $table->date('redeem_date');
            $table->string('redeem_ip', 40);
            $table->timestamps();

            $table->index('coupon_id');
            $table->index('customer_id');
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupons_redeem_track');
    }
}
