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
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/items_{id}', function ($id) {
    $item = App\Item::find($id);
    echo $item->name;
});
Route::get('/addtocart_itemid_{itemid}', 'HomeController@addToCart');


Route::get('/myinfo', 'InfoController@showInfo');

Route::get('/showDetail_itemid_{itemid}', 'HomeController@showDetail');

Route::get('/buy_itemid_{itemid}', 'HomeController@buy');

Route::get('/deletefromcart_itemid_{itemid}', 'HomeController@deleteFromCart');

route::get('/sellstuff', 'SellStuffController@index');

route::post('/publish', 'SellStuffController@publishGood');