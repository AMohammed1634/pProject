<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Providers\RouteServiceProvider;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master', function () {
    return view('masterView');
});
Route::get('/home','Controller@home')->name('home');

Route::get('/contact','Controller@contact')->name('contact');

Route::get('/register','Controller@register')->name('register');

Route::post('/register/store',"Controller@storeUser");

Route::get('/login','Controller@showLogin')->name('login');

Route::post('/login/store','Controller@login');

Route::get('viewProduct/{id}','Controller@viewProduct')->name('viewProduct.id');

Route::get('viewCategory/{id}','Controller@viewCategory');

Route::get('applaySort/{id}','Controller@applaySort')->name('applaySort');

Route::get('allCategories','Controller@allCategories')->name('allCategories');

Route::get('elements','elementController@showElements')->name('elements');
Route::get('edit/{id}','elementController@editElement')->name('elements.edit');

Route::post('edit/{id}/update','elementController@updateElement')->name('elements.update');

Route::get('logout','Controller@logout')->name('logout');

Route::post('addReview/{id}', 'Controller@addReview');

Route::get('viewProfile/{id}','Controller@viewProfile')->name('viewProfile');

Route::post('addImageProfile/{id}', 'Controller@addImageProfile')->name('addImageProfile');

Route::get('addToCart/{product}','elementController@addToCart')->name('addToCart'); //shopping_cart

Route::get('shoppingCart','elementController@shopping_cart')->name('shopping_cart');
Route::get('checkout','elementController@checkout')->name('checkout');

Route::get('tracking','elementController@tracking')->name('tracking');
Route::get('makeOrder','elementController@makeOrder')->name('makeOrder');
Route::post('track','elementController@track')->name('track');

Route::resource('product','ProductController');

 // Create A resource Product
/**/

Route::get('/addWishList/{product}','WishListController@addWishList')->name('addWishList');

Route::get("/setHotDeal","HotDealController@setHotDeal")->name('setHotDeal')->Middleware('auth');

Route::get('/getTime','HotDealController@getTimer')->name("getTime");
Route::post('/setHotDeal','HotDealController@storeTimer')->Middleware('auth');

Route::post('/fireDeal','HotDealController@fireDeal')->Middleware('auth');///fireDeal

Route::get('/updateQuantityCartincrement/{cart}','elementController@updateQuantityCartincrement')->Middleware('auth');

Route::get('/updateQuantityCartDecrement/{cart}','elementController@updateQuantityCartDecrement')->Middleware('auth');













