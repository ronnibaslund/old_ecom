<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 100);
            $table->string('firstname', 40)->nullable();
            $table->string('lastname', 40)->nullable();
            $table->string('organization', 50)->nullable();
            $table->string('street', 50);
            $table->string('street_extra', 50)->nullable();
            $table->string('city', 50);
            $table->string('state_ios_code_2', 2);
            $table->string('state_name', 60);
            $table->string('postcode', 11);
            $table->integer('country_id')->default(config::get('addresses.default_country_id'))->index();
            $table->string('country_iso_code_2', 2)->default(config::get('addresses.default_country'));
            $table->string('country_name', 60)->default(config::get('addresses.default_country_name'));
            $table->string('phone', 20)->nullable();
            $table->string('ean')->nullable();
            $table->string('cvr', 20)->nullable();
            $table->boolean('newsletter')->default(false);

            $table->timestamps();

            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
    }
}
