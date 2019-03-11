<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'code',
        'amount',
        'minimum_order_amount',
        'start_date',
        'expire_date',
        'uses_per_coupon',
        'uses_per_customer',
        'active',
        'restrict_to_products',
        'restrict_to_categories',
        'restrict_to_customers'
    ];

    //coupons_description
    /**
     * Get the descriptions for the product.
     */
    public function descriptions()
    {
        return $this->hasMany('App\CouponDescription', 'coupon_id');
    }
}
