<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', function () {
        return view('admin.layout');
    });

    Route::get('test', 'TestController@index');

    //
    // Products
    Route::get('products', 'ProductController@index');
    Route::get('product/create', 'ProductController@create');
    Route::put('product', 'ProductController@store');
    Route::get('product/{id}/edit', 'ProductController@edit');
    Route::post('product/{id}', 'ProductController@update');
    Route::get('product/{id}', 'ProductController@show');
    Route::get('products/search', 'ProductController@search');

    //
    // Media
    Route::get('media', 'MediaController@index');
    Route::get('media/folder', 'MediaController@createFolder');
    Route::put('media/folder', 'MediaController@storeFolder');
    Route::get('media/folder/delete', 'MediaController@destroyFolder');
    Route::put('media/image/upload', 'MediaController@store');
    Route::get('media/image/{id}', 'MediaController@showImage');
    Route::post('media/image/{id}/edit', 'MediaController@updateImage');

    /**
     * Used on product create / edit to add images to a product
     */
    Route::get('media/image/allimages/modal/{id?}', 'MediaController@allImagesModal');
    Route::post('media/product/images', 'MediaController@storeProductImages');
    Route::get('media/product/image/{id}/delete', 'MediaController@deleteProductImage');

    //
    // Coupons
    Route::get('coupons', 'CouponController@index');
    Route::get('coupon/create', 'CouponController@create');
    Route::put('coupon', 'CouponController@store');
    Route::get('coupon/{id}/edit', 'CouponController@edit');
    Route::post('coupon/{id}', 'CouponController@update');

    //
    // Gaft cards
    Route::get('giftcards', 'GiftcardsController@index');
    Route::get('giftcard/create', 'GiftcardsController@create');
    Route::put('giftcard', 'GiftcardsController@store');
    Route::get('giftcard/{id}/edit', 'GiftcardsController@edit');
    Route::post('giftcard/{id}', 'GiftcardsController@update');

    //
    // Pages
    Route::get('pages', 'PageController@index');
    Route::get('page/create', 'PageController@create');
    Route::put('page', 'PageController@store');
    Route::get('page/{id}/edit', 'PageController@edit');
    Route::post('page/{id}', 'PageController@update');

    //
    // Categories
    Route::get('categories', 'CategoriesController@index');
    Route::get('category/create', 'CategoriesController@create');
    Route::put('category', 'CategoriesController@store');
    Route::get('category/{id}/edit', 'CategoriesController@edit');
    Route::post('category/{id}', 'CategoriesController@update');

    //
    // Customers
    Route::get('customers', 'CustomersController@index');
    Route::get('customer/create', 'CustomersController@create');
    Route::put('customer', 'CustomersController@store');
    Route::get('customer/{id}/edit', 'CustomersController@edit');
    Route::post('customer/{id}', 'CustomersController@update');
    Route::get('customer/address/{id}/{type}', 'CustomersController@addressModal');
    Route::post('customer/address/update', 'CustomersController@addressModalUpdate');
    Route::get('customers/search', 'CustomersController@search');

    //
    // Orders
    Route::get('orders', 'OrdersController@index');
    Route::get('order/create', 'OrdersController@create');
    Route::put('order', 'OrdersController@store');

    Route::group(['prefix' => 'settings'], function () {

        //
        // TAX
        Route::get('tax', 'TaxSettingsController@index');
        Route::post('tax/configuration', 'TaxSettingsController@configurationUpdate');
        Route::get('tax/create', 'TaxSettingsController@create');
        Route::put('tax', 'TaxSettingsController@store');
        Route::get('tax/{id}/edit', 'TaxSettingsController@edit');
        Route::post('tax/{id}', 'TaxSettingsController@update');

        //
        // Email configuration
        Route::get('email', 'ConfigurationController@email');
        Route::post('email', 'ConfigurationController@emailStore');

        //
        // General configuration
        Route::get('general', 'ConfigurationController@general');
        Route::post('general', 'ConfigurationController@generalStore');

        //
        // Shipping
        Route::get('shipping', 'ConfigurationController@shipping');
        Route::post('shipping', 'ConfigurationController@shippingStore');
        Route::get('shipping/company/modal', 'ConfigurationController@shippingCompanyModal');
        Route::get('shipping/company/modal/{id}', 'ConfigurationController@shippingCompanyModalUpdate');
        Route::post('shipping/company', 'ConfigurationController@shippingCompanyCreate');
        Route::post('shipping/company/{id}/edit', 'ConfigurationController@shippingCompanyUpdate');
        Route::post('shipping/company/activate', 'ConfigurationController@shippingUpdateActiveCompanies');
        Route::get('shipping/company/price/delete/{id}', 'ConfigurationController@shippingPriceDelete');

        //
        // Product
        Route::get('product', 'ConfigurationController@product');
        Route::post('product', 'ConfigurationController@productStore');

        //
        // checkout
        Route::get('checkout', 'ConfigurationController@checkout');
        Route::post('checkout', 'ConfigurationController@checkoutStore');
    });

});

/*
|--------------------------------------------------------------------------
| Frontend / Customer Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Test af dynamisk routs

//$x = 3;
//for($i = 0; $i<=$x; $i++) {
//    Route::get('/test/'.$i, function () {
//
//        echo "Dette er en auto side";
//
//    });
//
//}
