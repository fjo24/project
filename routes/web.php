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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');//agregado para corregir error
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users','UsersController');
Route::resource('articles','ArticlesController');
Route::resource('orders','OrdersController');
Route::resource('providers','ProvidersController');
Route::resource('products','ProductsController');
Route::resource('registers','RegistersController');

Route::get('createpivot/{order_id}',  'OrdersController@createpivot')->name('createpivot');
Route::post('storepivot',  'OrdersController@storepivot')->name('storepivot');

Route::get('excelusers',  'UsersController@export')->name('exportusers');
