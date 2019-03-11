<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductToCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_categories';

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
        'product_id',
        'category_id'
    ];

    /**
     * Get the Category record associated with the product_category.
     */
    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    /**
     * Get the Product record associated with the media_product.
     */
    public function product()
    {
        return $this->hasOne('App\Products', 'id', 'product_id');
    }
}
