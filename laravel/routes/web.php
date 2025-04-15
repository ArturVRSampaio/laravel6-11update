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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/InventoryItem/index', 'InventoryItemController@index');
Route::get('/InventoryItem/{id}', 'InventoryItemController@details');

Route::post('/InventoryItem', 'InventoryItemController@create');
Route::put('/InventoryItem/{id}', 'InventoryItemController@update');
Route::delete('/InventoryItem/{id}', 'InventoryItemController@delete');

