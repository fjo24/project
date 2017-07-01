<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');//agregado para corregir error
Route::get('/home', 'HomeController@index')->name('home');

Route::get('confirm/{order_id}',  'OrdersController@confirm')->name('confirm');
Route::post('storepivot',  'OrdersController@storepivot')->name('storepivot');

Route::get('excelusers',  'UsersController@export')->name('exportusers');
Route::get('calendar',  'OrdersController@calendar')->name('calendar');
Route::get('pdf/{order_id}',  'OrdersController@pdf')->name('pdf');


Route::post('storeevent',  'OrdersController@storeevent')->name('storeevent');
Route::get('orders/{order_id}/editevent',  'OrdersController@editevent')->name('editevent');
Route::get('indexconfirmed',  'OrdersController@indexconfirmed')->name('indexconfirmed');
Route::get('createevent',  'OrdersController@createevent')->name('createevent');
Route::get('eventconfirmed/{order_id}',  'OrdersController@eventconfirmed')->name('eventconfirmed');
Route::get('reconfirmed/{order_id}',  'OrdersController@reconfirmed')->name('reconfirmed');

Route::get('search', [
	'uses' => 'OrdersController@search',
	'as' => 'search'
]);
Route::get('query/query', [
	'uses' => 'OrdersController@query',
	'as' => 'query'
]);

Route::get('we',  'InfoController@we')->name('we');

//activities
Route::get('activities',  'ActivitiesController@index')->name('activities');

Route::group(['prefix' => 'admin'], function () {
    //se agrego el middleware para que deba autenticarse para acceder a las rutas siguientes
	Route::resource('users','UsersController');
	Route::resource('providers','ProvidersController');
	Route::resource('products','ProductsController');
    Route::resource('events','EventController');
	Route::resource('orders','OrdersController');
    Route::resource('payments','PaymentsController');
    Route::get('modal', 'ProductsController@modal')->name('modal');
    Route::get('pay', 'PaymentsController@pay')->name('pay');
    Route::get('verified/{payment_id}',  'PaymentsController@verified')->name('verified');
    Route::get('ppdf/{payment_id}',  'PaymentsController@ppdf')->name('ppdf');
    //register of entries and removes
	Route::resource('registers','RegistersController');
    Route::get('registers/confirmregister/{register_id}',  'RegistersController@confirmregister')->name('confirmregister');
    Route::get('rpdf/{register_id}',  'RegistersController@rpdf')->name('rpdf');
});

Route::group(['prefix' => 'member'], function () {

    //Routes for members
    Route::get('member', 'UsersController@member')->name('member');
    Route::get('type', 'UsersController@type')->name('type');
    Route::get('showmember/{user}',  'UsersController@showmember')->name('showmember');

    // member person type
    Route::get('newperson', 'UsersController@newperson')->name('newperson');
    Route::post('storeperson', 'UsersController@storeperson')->name('storeperson');
    Route::get('Users/{User_id}/editperson',  'UsersController@editperson')->name('editperson');
    Route::put('person/updateperson/{user}', 'UsersController@updateperson')->name('updateperson');

    // member organization type
    Route::get('neworganization', 'UsersController@neworganization')->name('neworganization');
    Route::post('storeorganization', 'UsersController@storeorganization')->name('storeorganization');
    Route::get('Users/{User_id}/editorganization',  'UsersController@editorganization')->name('editorganization');
    Route::put('person/updateorganization/{user}', 'UsersController@updateorganization')->name('updateorganization');

    // products:member
    Route::get('indexproducts', 'ProductsController@indexproducts')->name('indexproducts');
    Route::get('showproduct/{Product_id}', 'ProductsController@showproduct')->name('showproduct');

                            //ORDERS-ORDERS-ORDERS-ORDERS
    // orders:member
    Route::get('indexorder', 'OrdersController@indexorder')->name('indexorder');
    Route::get('createorder', 'OrdersController@createorder')->name('createorder');
    Route::post('storeorder', 'OrdersController@storeorder')->name('storeorder');
    Route::get('total/{Order_id}', 'OrdersController@total')->name('total');
    Route::get('showorder/{Order_id}', 'OrdersController@showorder')->name('showorder');
    Route::get('orders/{Order_id}/editorder', 'OrdersController@editorder')->name('editorder');
    Route::put('orders/updateorder/{Order_id}', 'OrdersController@updateorder')->name('updateorder');
    Route::get('memberpdf/{Order_id}', 'OrdersController@memberpdf')->name('memberpdf');
    // PAYMENTS FOR MEMBERS
    Route::get('indexpay', 'PaymentsController@indexpay')->name('indexpay');
    Route::get('createpay', 'PaymentsController@createpay')->name('createpay');
    Route::post('storepay', 'PaymentsController@storepay')->name('storepay');
    Route::get('showpay/{Pay_id}', 'PaymentsController@showpay')->name('showpay');
    Route::get('memberpaypdf/{Pay_id}', 'PaymentsController@memberpaypdf')->name('memberpaypdf');

});