<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'customer_email',
        'customer_firstname',
        'customer_lastname',
        'customer_organization',
        'customer_street',
        'customer_city',
        'customer_postcode',
        'customer_country_name',
        'customer_phone',
        'customer_ean',
        'customer_cvr',
        'shipping_firstname',
        'shipping_lastname',
        'shipping_organization',
        'shipping_street',
        'shipping_city',
        'shipping_postcode',
        'shipping_country_name',
        'shipping_phone',
        'shipping_ean',
        'shipping_cvr',
        'billing_firstname',
        'billing_lastname',
        'billing_organization',
        'billing_street',
        'billing_city',
        'billing_postcode',
        'billing_country_name',
        'billing_phone',
        'billing_ean',
        'billing_cvr',
        'payment_method',
        'date_purchased',
        'status',
        'currency',
        'currency_value',
        'shipping_tax',
        'shipping_module',
        'referer_url',
        'ip_address'
    ];
}
