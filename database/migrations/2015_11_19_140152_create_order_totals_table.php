<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_totals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->index();
            $table->string('title')->default('');
            $table->string('text')->default('');
            $table->decimal('value', 15,2)->default(0.00);
            $table->string('class')->default('');
            $table->integer('sort_order')->default(0);
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
        Schema::drop('order_totals');
    }
}
