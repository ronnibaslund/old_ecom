<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'item_number',
        'manufacturer_item_number',
        'price',
        'featured_price',
        'cost',
        'date_available',
        'featured_until',
        'status',
        'featured',
        'tax_class_id',
        'manufacturer_id',
        'min_stock_quantity',
        'weight',
        'length',
        'width',
        'height',
        'backorders',
        'stock_status',
        'manage_stock',
        'image'
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

    // TODO: Add missing models association

    /**
     * Get the tags for the product.
     */
    public function tags()
    {
        return $this->hasMany('App\ProductTag', 'product_id');
    }

    /**
     * Get the descriptions for the product.
     */
    public function descriptions()
    {
        return $this->hasMany('App\ProductDescription', 'product_id');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function tax_class()
    {
        return $this->hasOne('App\TaxClass', 'tax_class_id', 'id');
    }


    /**
     * Get all of the medias for the product.
     */
    public function medias()
    {
        return $this->belongsToMany('App\Medias', 'media_product', 'product_id', 'media_id');
    }

    /**
     * Get all of the categories for the product.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'product_categories', 'product_id', 'category_id');
    }
}
