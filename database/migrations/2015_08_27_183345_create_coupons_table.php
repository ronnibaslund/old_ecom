<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->char('type', 1)->default('F'); // (F) = Fixed and (P) = Percent
            $table->string('code', 40);
            $table->decimal('amount', 8, 2)->default('0.00');
            $table->decimal('minimum_order_amount', 8, 2)->default('0.00');
            $table->dateTime('start_date');
            $table->dateTime('expire_date');
            $table->integer('uses_per_coupon')->default(1);
            $table->integer('uses_per_customer')->default(0);
            $table->boolean('active')->default(1);
            $table->string('restrict_to_products');
            $table->string('restrict_to_categories');
            $table->longText('restrict_to_customers');

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
        Schema::drop('coupons');
    }
}
