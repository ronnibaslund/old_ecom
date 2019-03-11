<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'firstname',
        'lastname',
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
        'newsletter'
    ];

    /**
     * Get the descriptions for the product.
     */
    public function addresses()
    {
        return $this->hasMany('App\Address', 'customer_id');
    }
}
