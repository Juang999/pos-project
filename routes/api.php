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

Route::post('register', 'UserControllerAPI@register');
Route::post('login', 'UserControllerAPI@login');
Route::get('book', 'BookController@book');

Route::get('bookall', 'BookController@bookAuth')->middleware('jwt.verify');
Route::get('user', 'UserControllerAPI@getAuthenticatedUser')->middleware('jwt.verify');

Route::group(['prefix' => 'member', 'middleware' => ['jwt.verify', 'role:1']], function () {
    Route::resource('/', 'TabunganController');
});

Route::group(['prefix' => 'kasir', 'middleware' => ['jwt.verify', 'role:2']], function () {
    Route::post('Store', 'KasirController@Store');
    Route::get('getTotal', 'KasirController@getTotal');
    Route::patch('payTotal', 'KasirController@payTotal');
});

Route::group(['prefix' => 'leader', 'middleware' => ['jwt.verify', 'role:4']], function () {
    Route::resource('/', 'JumlahControllerAPI');
});

Route::group(['prefix' => 'staf', 'middleware' => ['jwt.verify']], function () {
    Route::post('createSupplier', 'StafController@create');
    Route::post('createBarang', 'StafController@createBarang');
    Route::post('createCategory', 'StafController@postCategory');
    Route::post('buyStuff', 'StafController@buyStuff');
    Route::get('getTotal', 'StafController@getTotal');
    Route::patch('payTotal', 'StafController@payTotal');
    Route::get('getCategory', 'StafController@getCategory');
    Route::get('getBarang', 'StafController@getBarang');
    Route::get('getRiwayat', 'StafController@getRiwayat');

});
