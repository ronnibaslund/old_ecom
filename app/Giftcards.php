<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giftcards extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gift_cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'amount',
        'expire_date',
        'active'
    ];
}
