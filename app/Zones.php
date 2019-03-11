<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zones extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'code',
        'name'
    ];

}
