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

Route::post('register', 'UserControllerAPI@register');
Route::post('login', 'UserControllerAPI@login');
Route::get('book', 'BookController@book');

Route::get('bookall', 'BookController@bookAuth')->middleware('jwt.verify');
Route::get('user', 'UserControllerAPI@getAuthenticatedUser')->middleware('jwt.verify');

// Route::get('email/verify/{id}', 'Auth/VerificationController@verify')->name('verification.verify');
// Route::get('email/resend', 'Auth/VerificationController@resend')->name('verification.resend');


Route::group(['prefix' => 'member', 'middleware' => ['jwt.verify', 'role:1']], function () {
    Route::resource('/', 'TabunganController');
});

Route::group(['prefix' => 'kasir', 'middleware' => ['jwt.verify', 'role:2']], function () {
    Route::resource('/', 'TransaksiController');
});

Route::group(['prefix' => 'leader', 'middleware' => ['jwt.verify', 'role:4']], function () {
    Route::resource('/', 'JumlahControllerAPI');
});

Route::group(['prefix' => 'staf', 'middleware' => ['jwt.verify', 'role:3']], function () {
    Route::get('/', 'StafController@index');
    Route::post('postSupplier', 'StafController@create');
    Route::post('createGoods', 'StafController@createtGoods');
    Route::post('postCategory', 'StafController@postCategory');
    Route::get('getCategory', 'StafController@getCategory');
});
