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

Route::get('/', 'HomeController@showView')->name('home');
Route::get('/home', 'HomeController@showView')->name('home');
Route::get('/inventory', 'InventoryController@showView')->name('inventory');
Route::post('/add_new_item', 'InventoryController@doAddNewItem');
Route::post('/add_new_data_pembelian', 'HomeController@doAddNewDataPembelian');
Route::post('/edit_data_pembelian/{id}', 'HomeController@doEditDataPembelian');
Route::post('/delete_data_pembelian', 'HomeController@doDeleteDataPembelian');
Route::post('/export_data', 'HomeController@doExportData');
