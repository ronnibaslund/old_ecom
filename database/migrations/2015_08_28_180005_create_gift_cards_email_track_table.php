<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftCardsEmailTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_cards_email_track', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gift_card_id');
            $table->integer('customer_id');
            $table->string('name');
            $table->string('emailed_to');

            $table->timestamps();

            $table->index('gift_card_id');
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
        Schema::drop('gift_cards_email_track');
    }
}
