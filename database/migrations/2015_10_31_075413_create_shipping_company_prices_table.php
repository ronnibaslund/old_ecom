<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingCompanyPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_company_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipping_companies_id');
            $table->decimal('weight_from', 8, 2);
            $table->decimal('weight_to', 8, 2);
            $table->decimal('price', 8, 2);
            $table->integer('sort_order')->nullable();
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
        Schema::drop('shipping_company_prices');
    }
}
