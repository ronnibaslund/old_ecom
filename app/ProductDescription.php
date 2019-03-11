<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'language_id',
        'name',
        'description',
        'url',
        'viewed',
        'head_desc_tag',
        'head_keywords_tag'
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
     * Get the product that owns the description.
     */
    public function product()
    {
        return $this->belongsTo('App\Products');
    }

    /**
     * Scope a query to only include a specific language.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLanguage($query, $id)
    {
        if(!isset($id)) {
            $id = config('language_id');
        }

        return $query->where('language_id', '=', $id);
    }
}
