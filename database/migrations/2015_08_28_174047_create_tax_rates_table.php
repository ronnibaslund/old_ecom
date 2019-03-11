<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zone_id')->default(0);
            $table->integer('tax_class_id')->default(0);
            $table->integer('priority')->default(1);
            $table->decimal('rate', 7, 4)->default(0.0000);
            $table->string('description')->default('');

            $table->timestamps();

            $table->index('tax_class_id');
            $table->index('zone_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tax_rates');
    }
}