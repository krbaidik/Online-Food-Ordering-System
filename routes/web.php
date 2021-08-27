<?php

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

Route::post('/searchfood', 'foodcontroller@search');

Route::post('/feedback', 'foodcontroller@feedback');
Route::get('/all', 'foodcontroller@all');
Route::get('/food-list', 'foodcontroller@foodMenu')->name('food_menu');
Route::get('/food-details/{id}', 'foodcontroller@food_details')->name('details');
Route::get('cart','foodcontroller@carthandler');
Route::post('removecart/{id}','foodcontroller@removecart');
Route::post('updatecart/{id}','foodcontroller@updatecart');
Route::get('carts/{id}','foodcontroller@cart');
Route::get('/about-us', 'Admin\DashboardController@aboutUs');
Route::get('/how-to-order', 'Admin\DashboardController@howToOrder');


Route::group(['middleware'=>['auth','admin']], function(){

		Route::get('/dashboard', 'Admin\DashboardController@dashboard');
		Route::get('registered','Admin\DashboardController@registered');
		Route::post('userdelete','Admin\DashboardController@userdelete');
		Route::get('useredit/{id}','Admin\DashboardController@useredit');
		Route::post('submitform','Admin\DashboardController@submitform');
		Route::get('foodcategory','Admin\DashboardController@foodcategory');

		Route::post('submitcategory','Admin\DashboardController@submitcategory');

		Route::get('categorydelete/{id}','Admin\DashboardController@categorydelete');

		Route::get('district','Admin\DashboardController@district');

		Route::post('adddistrict','Admin\DashboardController@addDistrict');

		Route::get('districtdelete/{id}','Admin\DashboardController@districtDelete');

		Route::get('city','Admin\DashboardController@city');

		Route::post('addcity','Admin\DashboardController@addCity');

		Route::get('citydelete/{id}','Admin\DashboardController@cityDelete');

		Route::get('foodmenu','Admin\DashboardController@foodmenu');
		Route::get('addfood','Admin\DashboardController@addfood');
		Route::post('submitaddfood','Admin\DashboardController@submitaddfood');

		Route::get('foodedit/{id}','Admin\DashboardController@foodedit');
		Route::get('fooddelete/{id}','Admin\DashboardController@fooddelete');

		Route::post('submiteditfood','Admin\DashboardController@submiteditfood');

		Route::get('orders','Admin\DashboardController@orders');
		Route::post('update-order','Admin\DashboardController@updateorder');

		Route::post('search','Admin\DashboardController@search');
		Route::get('view-order-details/{id}','Admin\DashboardController@vieworders');


	});

	Route::get('/', 'foodcontroller@index')->name('frontend.home');



Route::group(['middleware'=>['auth','user']], function(){

	Route::get('myorders','foodcontroller@orders')->name('myorders');
	Route::post('orderfood','foodcontroller@orderfood')->name('orderfood');

	Route::get('esewa/success','esewaController@success')->name('esewa.success');
	Route::get('esewa/fail','esewaController@fail')->name('esewa.fail');
	
	Route::get('checkout','foodcontroller@checkout');
	Route::get('your-detail/{id}','foodcontroller@yourdetail');

	Route::post('get-city','foodcontroller@getCity')->name('getcity');

	Route::post('invoice', 'foodcontroller@invoice');
	Route::get('order-details', 'foodcontroller@order_details');

	Route::get('cancel_order/{id}', 'foodcontroller@cancel_order');

	Route::get('profile','foodcontroller@profile');
	Route::post('editaddress','foodcontroller@editAddress');

	Route::get('recommendation','foodcontroller@recommendation');
	Route::post('/rating', 'foodcontroller@rating')->name('rating');



});