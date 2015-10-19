<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', function () {
    return view('home', array('products' => App\Models\Product::all()->take(4)));
});

Route::get('shop', 'PageController@shop');
Route::get('my-cart', 'PageController@myCart');

Route::post('cart/items', 'CartController@addToCart');
Route::delete('cart/items/{id}', 'CartController@removeFromCart');
Route::put('cart/items', 'CartController@changeQuantity');
Route::get('cart', 'CartController@getCart');
Route::post('cart/card', 'CartController@addCardInfo');

Route::post('address', 'AddressController@address');

Route::get('product/{id}', function($id) {
    return view('product', array('product' => App\Models\Product::find($id)->first()));
});

Route::get('about', function() {
    return view('about', array());
});
Route::get('review', 'PageController@review');
Route::get('thank-you', 'PageController@thankYou');


$path = storage_path().'/logs/query.log';

Event::listen('illuminate.query', function($sql, $bindings, $time) use($path) {
    // Uncomment this if you want to include bindings to queries
    //$sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
    //$sql = vsprintf($sql, $bindings);
    $time_now = (new DateTime)->format('Y-m-d H:i:s');;
    $log = $time_now.' | '.$sql.' | '.$time.'ms'.PHP_EOL;
    File::append($path, $log);
});
