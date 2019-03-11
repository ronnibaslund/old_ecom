<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medias extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file',
        'title',
        'description'
    ];
}
