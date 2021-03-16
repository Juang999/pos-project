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
Route::group(['prefix' => 'super-admin', 'middleware' => ['auth', 'role:5']], function () {

    //--=[STAF]=--
    Route::get('staf', 'AdminController@getStaf');

    //crudBarang
    Route::delete('staf/delete/{id}', 'AdminController@stafDelete');
    Route::post('/store', 'AdminController@createData');
    Route::get('/show/{id}', 'AdminController@showData');
    Route::patch('/edit/{id}', 'AdminController@editData');

    //crudSupplier
    Route::get('/createSupplier', 'AdminController@createSupplier');
    Route::post('/storeSupplier', 'AdminController@storeSupplier');
    Route::delete('deleteSupplier/{id}', 'AdminController@deleteSupplier');
    Route::get('/showSupplier/{id}', 'AdminController@showSupplier');
    Route::patch('/editSupplier/{id}', 'AdminController@editSupplier');

    //crudKategori
    Route::get('/createKategori', 'AdminController@createKategori');
    Route::post('/storeKategori', 'AdminController@storeKategori');
    Route::delete('/deleteKategori/{id}', 'AdminController@deleteKategori');
    Route::get('/showKategori/{id}', 'AdminController@showKategori');
    Route::patch('/editKategori/{id}', 'AdminController@editKategori');

    //--=[OFFICER]=--
    Route::get('officer', 'AdminController@getOfficer');
    //crudOfficer
    Route::get('createOfficer', 'AdminController@createOfficer');
    Route::post('storeOfficer', 'AdminController@storeOfficer');
});
