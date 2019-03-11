<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'status'
    ];


    /**
     * Get the descriptions for the product.
     */
    public function descriptions()
    {
        return $this->hasMany('App\PageDescription', 'page_id');
    }

    /**
     * Get children of the current page
     * @return mixed
     */
    public function children() {
        return $this->where('parent_id', '=', $this->id)->get();
    }
}
