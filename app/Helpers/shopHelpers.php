<?php
/**
 * Created by PhpStorm.
 * User: ronnibaslund
 * Date: 04/10/15
 * Time: 18.50
 */

use Illuminate\Support\Facades\DB;

if (! function_exists('shop_config')) {
    /**
     * Get the specified shop configuration value.
     *
     * If an value is passed in the value, we will assume you want to set / update the config.
     *
     * @param  array|string  $key
     * @param  mixed  $group
     * @param  mixed  $value
     * @return mixed
     */
    function shop_config($key = null, $group = 'GENERAL', $value = null)
    {
        //If value is not null the update the database
        if(!is_null($value)) {

            $entity = \App\Configuration::firstOrNew(['key'=>$key, 'group'=>$group]);
            $entity->value = $value;
            $entity->group = $group;
            $entity->save();

            return $value;
        }

        // If group is not set then look only for the KEY
        if(is_null($group)) {
            $entity = DB::table('configuration')->where('key',$key)->first();
        } else {
            $entity = DB::table('configuration')->where('group',strtoupper($group))->where('key',$key)->first();
        }

        // If the value of the entity is not set then response with empty string
        if(!isset($entity->value)) {
            $response = '';
        } else {
            $response = $entity->value;
        }

        return $response;
    }
}