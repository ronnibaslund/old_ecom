<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{

//
//CREATE TABLE products
//(
//products_ordered INT DEFAULT 0 NOT NULL,
//products_compare_status TINYINT DEFAULT 1 NOT NULL,
//products_qty_blocks INT DEFAULT 1 NOT NULL
//);

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->default(0);
            $table->string('item_number')->nullable();
            $table->string('manufacturer_item_number')->nullable();
            $table->decimal('price', 15, 4)->default('0.0000');
            $table->decimal('featured_price', 15, 4)->default('0.0000');
            $table->decimal('cost', 15, 4)->default('0.0000');
            $table->dateTime('date_available');
            $table->date('featured_until');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->integer('tax_class_id')->default(0);
            $table->integer('manufacturer_id');
            $table->string('image');
            $table->integer('min_stock_quantity');
            $table->decimal('weight', 5, 2)->default('0.00');
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
            $table->string('backorders');
            $table->string('stock_status');
            $table->boolean('manage_stock')->default(true);

            $table->timestamps();

            $table->index('tax_class_id');
            $table->index('manufacturer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
