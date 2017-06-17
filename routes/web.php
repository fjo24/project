<?php


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

Route::get('confirm/{order_id}',  'OrdersController@confirm')->name('confirm');
Route::post('storepivot',  'OrdersController@storepivot')->name('storepivot');

Route::get('excelusers',  'UsersController@export')->name('exportusers');
Route::get('calendar',  'OrdersController@calendar')->name('calendar');
Route::get('pdf/{order_id}',  'OrdersController@pdf')->name('pdf');
