<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urls extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'urls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'new_url',
        'type',
        'content_id',
        'controller',
        'controller_method',
        'method',
        'action'
    ];


    /**
     * @param string|string $url
     * @param int|int $content_id An id on the resource
     * @param string|string $controller
     * @param string|string $controller_method
     * @param string|string $method
     * @param string $new_url
     * @param string|string $action
     */
    public static function page($url, $content_id, $controller, $controller_method, $method = 'GET', $new_url = '', $action = '') {
        Urls::create_entry($url, $content_id, $controller, $controller_method, $method, $new_url, $action, 'PAGE');
    }

    /**
     * @param string|string $url
     * @param int|int $content_id An id on the resource
     * @param string|string $controller
     * @param string|string $controller_method
     * @param string|string $method
     * @param string $new_url
     * @param string|string $action
     */
    public static function product($url, $content_id, $controller, $controller_method, $method = 'GET', $new_url = '', $action = '') {
        Urls::create_entry($url, $content_id, $controller, $controller_method, $method, $new_url, $action, 'PRODUCT');
    }

    /**
     * @param string|string $url
     * @param int|int $content_id An id on the resource
     * @param string|string $controller
     * @param string|string $controller_method
     * @param string|string $method
     * @param string $new_url
     * @param string|string $action
     */
    public static function category($url, $content_id, $controller, $controller_method, $method = 'GET', $new_url = '', $action = '') {
        Urls::create_entry($url, $content_id, $controller, $controller_method, $method, $new_url, $action, 'CATEGORY');
    }

    /**
     * @param array $url
     * @param $content_id
     * @param $controller
     * @param $controller_method
     * @param string $method
     * @param string $new_url
     * @param string $action
     * @param $type
     * @return void|static
     */
    public static function create_entry($url, $content_id, $controller, $controller_method, $method = 'GET', $new_url = '', $action = '', $type) {
        // Retrieve the urls by the attributes, or instantiate a new instance...
        $url_db = Urls::where('type', '=', $type)->where('content_id', '=', $content_id)->orderBy('created_at', 'desc')->first();



        if(isset($url_db->id)) {

            // Make sure the url is different else do nothing
            if($url_db->url != $url) {
                // If exist then SET old entry to a 301 redirect and create a new entry
                $url_db->new_url = $url;
                $url_db->action = '301';
                $url_db->save();

                $url_new = new Urls();
                $url_new->url = $url;
                $url_new->type = $type;
                $url_new->content_id = $content_id;
                $url_new->controller = $controller;
                $url_new->controller_method = $controller_method;
                $url_new->method = $method;
                $url_new->action = $action;
                $url_new->save();
            }

        } else {

            // If we don´t find en entry we create a new
            $url_db = new Urls();
            $url_db->url = $url;
            $url_db->type = $type;
            $url_db->content_id = $content_id;
            $url_db->controller = $controller;
            $url_db->controller_method = $controller_method;
            $url_db->method = $method;
            $url_db->action = $action;
            $url_db->save();
        }
    }

}
