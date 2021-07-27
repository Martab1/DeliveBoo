<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Auth::routes();

Route::prefix('admin')
       ->namespace('Admin')
       ->middleware('auth')
       ->name('admin.')
       ->group( function(){
            //rotte home admin
            Route::get('/', 'HomeController@index')->name('home');
            //controller restaurant
            Route::get('orders/{id}', ['as' => 'restaurant.orders', 'uses' => 'RestaurantController@orders']);
            Route::resource('/restaurant', "RestaurantController");
            // home products
            Route::get('products/{id}', ['as' => 'product.index', 'uses' => 'ProductController@index']);
            Route::get('products/create/{id}', ['as' => 'product.create', 'uses' => 'ProductController@create']);
            // Route::get('products/store/{id}', ['as' => 'product.store', 'uses' => 'ProductController@store']);
            // controller product
            Route::resource('/product', "ProductController", ['except' => ['index', 'create']]);
       });

       Route::get('/charts/{id}', 'ChartController@index')->name("charts");

 Route::get('{any?}', function () {
    return view('guest.welcome');
 })->where('any', '.*');
 



