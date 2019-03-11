<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurring_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('order_info');
            $table->longText('products');
            $table->date('next');
            $table->string('recurring_every');
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
        Schema::drop('recurring_orders');
    }
}
