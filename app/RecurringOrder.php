<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecurringOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recurring_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_info',
        'products',
        'next',
        'recurring_every'
    ];
}
