<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        CREATE TABLE zones
//    (
//        zone_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
//    zone_country_id INT DEFAULT 0 NOT NULL,
//    zone_code VARCHAR(32) DEFAULT '' NOT NULL,
//    zone_name VARCHAR(32) DEFAULT '' NOT NULL
//);

        Schema::create('zones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->default(0);
            $table->string('code', 40)->default('');
            $table->string('name', 40)->default('');

            $table->timestamps();

            $table->index('country_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('zones');
    }
}
