<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->index();
            $table->string('type')->default('private')->index();
            $table->integer('customer_notified')->default(0);
            $table->integer('user_id')->index();
            $table->string('user_name');
            $table->longText('note');
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
        Schema::drop('order_notes');
    }
}
