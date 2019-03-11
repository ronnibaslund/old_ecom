<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'language_id',
        'name'
    ];

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

    /**
     * Delete all old product tags and create the new on the database
     *
     * @param string $tags string with , as delimiter
     * @param int $product_id product id
     * @param int $language_id The current language id
     */
    public static function stringSave($tags, $product_id, $language_id) {

        // If language id is not set then get the one from config
        if(!isset($language_id)) {
            $language_id = config('language_id');
        }

        // If tags are set we delete all the old tags
        if(isset($tags)) {
            ProductTag::where('product_id', $product_id)->where('language_id', $language_id)->delete();
        }

        // Convert the string to array
        $tags = explode(',',$tags);

        // Save all new tags to the database
        foreach($tags as $tag) {
            ProductTag::firstOrCreate(['product_id' => $product_id, 'name' => trim($tag), 'language_id' => $language_id]);
        }
    }
}
