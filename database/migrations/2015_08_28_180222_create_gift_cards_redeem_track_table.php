<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftCardsRedeemTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_cards_redeem_track', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gift_card_id');
            $table->integer('customer_id');
            $table->integer('order_id');
            $table->date('redeem_date');
            $table->string('redeem_ip', 40);
            $table->timestamps();

            $table->index('gift_card_id');
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
        Schema::drop('gift_cards_redeem_track');
    }
}
