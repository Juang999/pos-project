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

//mengambil semua jumlah barang
Route::get('get-all-jumlah', 'BarangController@getJumlah');

Route::group(['prefix' => 'member', 'middleware' => ['jwt.verify', 'role:1']], function () {
    Route::resource('/', 'TabunganController');
});

Route::group(['prefix' => 'kasir', 'middleware' => ['jwt.verify', 'role:2']], function () {
    Route::post('sell', 'KasirController@Store');
    Route::get('get-total', 'KasirController@getTotal');
    Route::delete('delete-sale/{id}/remove', 'KasirController@deleteSale');
    Route::patch('pay', 'KasirController@payTotal');
    Route::patch('pay-member', 'KasirController@payMember');
    Route::post('input-saldo-member', 'KasirController@inputSaldoMember');
    Route::get('get-story', 'KasirController@getHistory');
});

Route::group(['prefix' => 'leader', 'middleware' => ['jwt.verify', 'role:4']], function () {
    Route::get('get-trans-penjualan', 'LeaderController@getTransPenjualan');
    Route::get('get-trans-pembelian', 'LeaderController@getTransPembelian');
});

Route::group(['prefix' => 'staf', 'middleware' => ['jwt.verify']], function () {
    //supplier
    Route::post('create-supplier', 'StafController@create');
    Route::get('get-supplier', 'StafController@index');
    Route::patch('update-supplier/{id}/edit', 'StafController@updateSupplier');
    Route::delete('delete-supplier/{id}/remove', 'StafController@deleteSupplier');
    //category
    Route::post('create-category', 'StafController@postCategory');
    Route::get('get-category', 'StafController@getCategory');
    Route::patch('update-category/{id}/edit', 'StafController@updateCategory');
    Route::delete('delete-category/{id}/remove', 'StafController@deleteCategory');

    //stuff
    Route::post('create-stuff', 'StafController@createBarang');
    Route::get('get-stuff', 'StafController@getBarang');
    Route::patch('update-stuff/{id}/edit', 'StaffController@editStuff');
    Route::delete('delete-stuff/{id}/remove', 'StafController@deleteStuff');

    //buy Stuff
    Route::post('order', 'StafController@buyStuff');
    Route::get('get-total', 'StafController@getTotal');
    Route::delete('delete-order/{id}/remove', 'StafController@deleteOrder');
    Route::patch('pay', 'StafController@payTotal');

    //history
    Route::get('get-story', 'StafController@getRiwayat');

});
