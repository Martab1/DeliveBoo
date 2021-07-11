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
            Route::resource('/restaurant', "RestaurantController");
       });


 Route::get('{any?}', function () {
    return view('guest.welcome');
 })->where('any', '.*');


