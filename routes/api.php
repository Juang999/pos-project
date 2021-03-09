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
    //Sell
    Route::post('sale', 'KasirController@Store');
    Route::get('sales', 'KasirController@getTotal');
    Route::patch('sale/{id}/update', 'KasirController@udpateSale');
    Route::delete('sale/{id}/delete', 'KasirController@deleteSale');
    Route::patch('pay', 'KasirController@payTotal');
    Route::patch('pay-member', 'KasirController@payMember');

    //InputSaldo
    Route::post('input-saldo-member', 'KasirController@inputSaldoMember');

    //History
    Route::get('get-story', 'KasirController@getHistory');

    //Absensi
    Route::post('absent', 'KasirController@absent');
});

Route::group(['prefix' => 'leader', 'middleware' => ['jwt.verify', 'role:4']], function () {
    //Histories
    Route::get('get-trans-penjualan', 'LeaderController@getTransPenjualan');
    Route::get('get-trans-pembelian', 'LeaderController@getTransPembelian');

    //tambahKaryawan
    Route::post('officer', 'LeaderController@registerKaryawan');
});

Route::group(['prefix' => 'staf', 'middleware' => ['jwt.verify']], function () {
    //Supplier
    Route::post('supplier', 'StafController@create');
    Route::get('suppliers', 'StafController@index');
    Route::patch('supplier/{id}/update', 'StafController@updateSupplier');
    Route::delete('supplier/{id}/delete', 'StafController@deleteSupplier');

    //Category
    Route::post('category', 'StafController@postCategory');
    Route::get('categories', 'StafController@getCategory');
    Route::patch('category/{id}/update', 'StafController@updateCategory');
    Route::delete('category/{id}/delete', 'StafController@deleteCategory');

    //Stuff
    Route::post('goods', 'StafController@createBarang');
    Route::get('goods', 'StafController@getBarang');
    Route::patch('goods/{id}/update', 'StaffController@editStuff');
    Route::delete('goods/{id}/delete', 'StafController@deleteStuff');

    //Buy Stuff
    Route::post('order', 'StafController@buyStuff');
    Route::get('orders', 'StafController@getTotal');
    Route::patch('order/{id}/update', 'StafController@updateOrder');
    Route::delete('order/{id}/delete', 'StafController@deleteOrder');
    Route::patch('pay', 'StafController@payTotal');

    //History
    Route::get('histories', 'StafController@getRiwayat');

});
