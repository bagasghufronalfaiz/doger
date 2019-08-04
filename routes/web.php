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

Route::group(['middleware'=>'auth'], function(){
    Route::get('/domain/adddomain', 'DomainController@create')->name('adddomain');
    Route::post('/domain', 'DomainController@store');
    Route::get('/domain/{id}/editdomain', 'DomainController@edit');
    Route::put('/domain/{id}', 'DomainController@update');
    Route::delete('/domain/{id}', 'DomainController@destroy');

    Route::get('/registrar/addregistrar', 'RegistrarController@create')->name('addregistrar');
    Route::post('/registrar', 'RegistrarController@store');
    Route::get('/registrar/{id}/editregistrar', 'RegistrarController@edit');
    Route::put('/registrar/{id}', 'RegistrarController@update');
    Route::delete('/registrar/{id}', 'RegistrarController@destroy');
});


Route::get('/', function () {
    if(Auth::check())
    {
        return view('welcome');
    } else {
        return view('welcome-copy');
    }
});


Auth::routes();

Route::get('/registrar', 'RegistrarController@index')->name('registrar');
Route::get('/domain', 'DomainController@index')->name('domain');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/server', 'ServerController@index')->name('server');
