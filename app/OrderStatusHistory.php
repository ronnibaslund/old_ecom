<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_status_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'orders_status_id',
        'customer_notified',
        'comments'
    ];
}
