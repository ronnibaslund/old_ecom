<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponDescription extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coupons_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coupon_id',
        'language_id',
        'name',
        'description'
    ];


}
