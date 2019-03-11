<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sort_order',
        'path',
        'categories_featured',
        'categories_featured_until',
        'status',
        'parent_id'
    ];

    protected $guarded = array('id');

    /**
     * Get the descriptions for the product.
     */
    public function descriptions()
    {
        return $this->hasMany('App\CategoryDescription', 'category_id');
    }

    /**
     * Get all children that belongs to the node
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }

    /**
     * Get parent that belongs to the node
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('Category', 'parent_id');
    }
}
