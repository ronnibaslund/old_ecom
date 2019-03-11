<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tax_class';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * Get the rates for the tax class.
     */
    public function rates()
    {
        return $this->hasMany('App\TaxRates', 'tax_class_id');
    }
}
