<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('data_pembelian','API\APIHandler@getDataPembelian');
Route::get('inventory','API\APIHandler@getInventory');
Route::get('get_item','API\APIHandler@getItemsOption');
Route::get('get_item/{id}','API\APIHandler@getSingleItem');
