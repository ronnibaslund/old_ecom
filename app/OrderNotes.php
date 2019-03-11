<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderNotes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'type', // 1 = private, 2 = public
        'customer_notified',
        'user_id',
        'user_name',
        'note'
    ];
}
