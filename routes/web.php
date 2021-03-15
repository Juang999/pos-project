<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/user', 'WebController1@read');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Super Admin
Route::group(['prefix' => 'super-admin', 'middleware' => ['role:5']], function () {

    //Staf
    Route::get('staf', 'AdminController@stafRead');
        //deleteBarang
        Route::delete('staf/delete/{id}', 'AdminController@stafDelete');
        //storeBarang
        Route::post('/store', 'AdminController@createData');
        //editBarang
        Route::patch('/store/edit/{id}', 'AdminController@editData');

    Route::get('officer', function () {
        return view('superadmin.officer');
    });

    Route::get('leader', function () {
        return view('superadmin.leader');
    });

});
