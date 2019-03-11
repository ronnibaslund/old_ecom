<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = array(
        'customer_id',
        'firstname',
        'lastname',
        'organization',
        'street',
        'street_extra',
        'city',
        'state_ios_code_2',
        'state_name',
        'postcode',
        'country_id',
        'country_iso_code_2',
        'country_name',
        'phone',
        'ean',
        'cvr',
        'is_primary',
        'is_billing',
        'is_shipping',
        'latitude',
        'longitude'
    );

    protected $guarded = array(
        'id'
    );

    /**
     * Fetch primary address
     *
     * @return Address or null
     */
    public function primaryAddress() {
        return $this->orderBy('is_primary', 'DESC')->first();
    }

    /**
     * Fetch billing address
     *
     * @return Address or null
     */
    public function billingAddress() {
        return $this->orderBy('is_billing', 'DESC')->first();
    }

    /**
     * Fetch billing address
     *
     * @return Address or null
     */
    public function shippingAddress() {
        return $this->orderBy('is_shipping', 'DESC')->first();
    }
}
