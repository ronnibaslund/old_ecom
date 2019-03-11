<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->index();
            $table->string('customer_email');
            $table->string('customer_firstname');
            $table->string('customer_lastname');
            $table->string('customer_organization')->nullable();
            $table->string('customer_street');
            $table->string('customer_city');
            $table->string('customer_postcode');
            $table->string('customer_country_name');
            $table->string('customer_phone');
            $table->string('customer_ean')->nullable();
            $table->string('customer_cvr')->nullable();

            $table->string('shipping_firstname');
            $table->string('shipping_lastname');
            $table->string('shipping_organization')->nullable();
            $table->string('shipping_street');
            $table->string('shipping_city');
            $table->string('shipping_postcode');
            $table->string('shipping_country_name');
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_ean')->nullable();
            $table->string('shipping_cvr')->nullable();

            $table->string('billing_firstname');
            $table->string('billing_lastname');
            $table->string('billing_organization')->nullable();
            $table->string('billing_street');
            $table->string('billing_city');
            $table->string('billing_postcode');
            $table->string('billing_country_name');
            $table->string('billing_phone');
            $table->string('billing_ean')->nullable();
            $table->string('billing_cvr')->nullable();

            $table->string('payment_method');
            $table->dateTime('date_purchased');

            $table->integer('status')->default('1')->index();

            $table->string('currency', 3);
            $table->decimal('currency_value', 15, 2)->default(0.00);
            $table->decimal('shipping_tax', 15,2)->default(0.00);
            $table->string('shipping_module');
            $table->decimal('total', 15, 2)->default(0.00);
            $table->string('referer_url')->nullable();
            $table->string('ip_address')->nullable();

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
        Schema::drop('orders');
    }
}

/*
    cc_type VARCHAR(20),
    cc_owner VARCHAR(64),
    cc_number VARCHAR(32),
    cc_expires VARCHAR(4),
    orders_date_finished DATETIME,
    cc_transactionid VARCHAR(32) DEFAULT 'NULL',
    customer_service_id VARCHAR(15),
    cc_fraudstatus VARCHAR(64) DEFAULT 'NULL',
    cc_transfee VARCHAR(64) DEFAULT 'NULL',
    cc_client_callback_ip VARCHAR(64) DEFAULT 'NULL',
    cc_payment_amount VARCHAR(64) DEFAULT 'NULL',
    cc_cardtype_id VARCHAR(64) DEFAULT 'NULL',
    cc_currency VARCHAR(64) DEFAULT 'NULL',
    cc_captured_amount VARCHAR(64) DEFAULT 'NULL',
    cc_captured_date DATETIME,
    cc_credited_amount VARCHAR(64) DEFAULT 'NULL',
    cc_credited_date DATETIME,
    cc_deleted_date DATETIME,
    cc_cardnopostfix VARCHAR(64) DEFAULT 'NULL',
    ip_address VARCHAR(94) DEFAULT '' NOT NULL,
    epay_group VARCHAR(20) DEFAULT '' NOT NULL,
    cookie_value VARCHAR(255)
*/