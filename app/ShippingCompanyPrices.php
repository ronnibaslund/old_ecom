<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingCompanyPrices extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shipping_company_prices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shipping_companies_id',
        'weight_from',
        'weight_to',
        'price',
        'sort_order',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the shipping company that owns the price.
     */
    public function company()
    {
        return $this->belongsTo('App\ShippingCompanies');
    }


    public static function createPrices (array $data, $company_id) {
        // Save all shipping prices
        foreach ($data as $d) {
            $d['shipping_companies_id'] = $company_id;
            ShippingCompanyPrices::create($d);
        }
    }
}
