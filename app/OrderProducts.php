<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'item_number',
        'name',
        'qty',
        'cost',
        'price',
        'tax',
        'subtotal'
    ];
}
