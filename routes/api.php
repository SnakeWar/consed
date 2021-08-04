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

Route::group(['middleware' => 'cors',  'namespace' => 'Api', 'prefix' => 'public'], function(){
    Route::get('products', 'VitrineController@products');
    Route::get('products/filter', 'VitrineController@products_filter');
    Route::get('segments', 'VitrineController@segments');
    Route::get('stores', 'VitrineController@stores');
});

Route::group(['middleware' => ['auth:token'], 'namespace' => 'Api'], function () {
    Route::resource('products', 'ProductController');
});