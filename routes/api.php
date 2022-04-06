<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'StafController@index')->middleware('jwt.verify');

Route::post('register', 'Api\UserController@register');
Route::post('login', 'Api\UserController@login');
Route::get('book', 'BookController@book');

Route::get('bookall', 'BookController@bookAuth')->middleware('jwt.verify');
Route::get('user', 'Api\UserController@getAuthenticatedUser')->middleware('jwt.verify');


// Route::post('password/email', 'UserControllerAPI@resetPassword');

// Supplier endpoint
Route::group(['prefix' => 'supplier', 'middleware' => ['jwt.verify']], function() {
    Route::get('/', 'Api\SupplierController@index');
    Route::get('/show-supplier/{id}', 'Api\SupplierController@show');
    Route::post('/store-supplier', 'Api\SupplierController@store');
    Route::put('/update-supplier/{id}', 'Api\SupplierController@update');
    Route::delete('/delete-supplier/{id}', 'Api\SupplierController@destroy');
});

// Category endpoint
Route::group(['prefix' => 'category', 'middleware' => ['jwt.verify']], function() {
    Route::get('/', 'Api\CategoryController@index');
    Route::post('/store-category', 'Api\CategoryController@store');
    Route::put('/update-category/{id}', 'Api\CategoryController@update');
    Route::delete('/delete-category/{id}', 'Api\CategoryController@destroy');
});

Route::group(['prefix'=> 'goods', 'middleware' => ['jwt.verify']], function() {
    Route::get('/', 'Api\GoodsController@index');
    Route::post('/store-goods', 'Api\GoodsController@store');
});

Route::group(['prefix' => 'warehouse-admin', 'middleware' => ['jwt.verify']], function() {

});
