<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageDescription extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
        'name',
        'content',
        'url',
        'language_id'
    ];


    /**
     * Get the product that owns the description.
     */
    public function page()
    {
        return $this->belongsTo('App\Pages');
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
