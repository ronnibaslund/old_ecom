<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Configuration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configuration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'key',
        'value',
        'description',
        'group',
        'sort_order'
    ];

    /**
     * Update or create a new configuration key in the configuration table
     * @param Request $request From input data
     * @param string $configurationGroup
     * @param array $except comma sep string
     */
    public static function insertConfiguration(Request $request, $configurationGroup = '', array $except = array())
    {

        array_push($except, '_token');
        $input = $request->except($except);

        foreach ($input as $key => $value) {

            $entity = Configuration::firstOrNew(['key' => $key, 'group' => $configurationGroup]);

            if(is_string($value)) {
                $entity->value = $value;
            } elseif (is_array($value)) {
                $entity->value = json_encode($value);
            }
            $entity->group = $configurationGroup;
            $entity->save();

        }
    }
}
