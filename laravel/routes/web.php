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

Route::get('/InventoryItem', 'InventoryItemController@index')->name('InventoryItem.index');
Route::get('/InventoryItem/new', 'InventoryItemController@createForm')->name('InventoryItem.createForm');

Route::post('/InventoryItem', 'InventoryItemController@create')->name('InventoryItem.create');
Route::get('/InventoryItem/{id}', 'InventoryItemController@edit')->name('InventoryItem.edit');
Route::put('/InventoryItem/{id}', 'InventoryItemController@update')->name('InventoryItem.update');
Route::delete('/InventoryItem/{id}', 'InventoryItemController@delete')->name('InventoryItem.delete');

