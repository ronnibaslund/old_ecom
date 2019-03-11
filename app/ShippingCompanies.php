<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingCompanies extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shipping_companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sort_order'
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
     * Get the tags for the product.
     */
    public function prices()
    {
        return $this->hasMany('App\ShippingCompanyPrices', 'shipping_companies_id');
    }

    /**
     * Change active state on a shipping company
     *
     * @param int $id
     * @param int $status
     */
    public static function setActiveState($id, $status) {
        $entry = ShippingCompanies::find($id);
        $entry->active = $status;
        $entry->save();
    }
}
