<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaToProduct extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media_product';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'media_id',
        'product_id'
    ];

    /**
     * Get the Media record associated with the media_product.
     */
    public function media()
    {
        return $this->hasOne('App\Medias', 'id', 'media_id');
    }

    /**
     * Get the Product record associated with the media_product.
     */
    public function product()
    {
        return $this->hasOne('App\Products', 'id', 'product_id');
    }
}
