<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTotals extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_totals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'title',
        'text',
        'value',
        'class',
        'sort_order'
    ];
}
