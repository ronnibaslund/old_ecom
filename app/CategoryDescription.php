<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'title_tag',
        'desc_tag',
        'keywords_tag',
        'description',
        'title',
        'language_id'
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
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Scope a query to only include a specific language.
     *
     * @param $query
     * @param string $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLanguage($query, $id)
    {
        return $query->where('language_id', '=', $id);
    }
}
