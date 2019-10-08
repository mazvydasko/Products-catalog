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

Route::get('/', 'FrontController@index')->name('products');

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin', 'AdminController');
Route::get('delete/{id}', 'AdminController@destroy')->name('admin.delete');
Route::delete('/deletemany', 'AdminController@destroyMany')->name('admin.deletemany');

Route::get('/config', 'BasicConfigController@index')->name('config.index');
Route::post('/config/set-tax-rate', 'BasicConfigController@setTaxRate')->name('config.setTaxRate');
Route::post('/config/set-global-discount', 'BasicConfigController@setGlobalDiscount')->name('config.setGlobalDiscount');
Route::post('/config/set-tax-flag', 'BasicConfigController@setTaxFlag')->name('config.setTaxFlag');

Route::get('/product/{id}', 'FrontController@show')->name('product.show');
Route::post('/product/review', 'FrontController@postRating')->name('product.postRating');

