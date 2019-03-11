<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxRates extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tax_rates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zone_id',
        'tax_class_id',
        'priority',
        'rate',
        'description'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function taxClass()
    {
        return $this->hasOne('App\TaxClass', 'id', 'tax_class_id');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function zone()
    {
        return $this->hasOne('App\Zones', 'id', 'zone_id');
    }
}
