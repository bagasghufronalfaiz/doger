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
    Route::get('/domain/{id}/editdomain', 'DomainController@edit')->name('editdomain');
    Route::put('/domain/{id}', 'DomainController@update');
    Route::delete('/domain/{id}', 'DomainController@destroy')->name('deletedomain');

    Route::get('/registrar/addregistrar', 'RegistrarController@create')->name('addregistrar');
    Route::post('/registrar', 'RegistrarController@store');
    Route::get('/registrar/{id}/editregistrar', 'RegistrarController@edit')->name('editregistrar');
    Route::put('/registrar/{id}', 'RegistrarController@update');
    Route::delete('/registrar/{id}', 'RegistrarController@destroy')->name('deleteregistrar');

    Route::get('/server/addserver', 'ServerController@create')->name('addserver');
    Route::post('/server', 'ServerController@store');
    Route::get('/server/{id}/editserver', 'ServerController@edit')->name('editserver');
    Route::put('/server/{id}', 'ServerController@update');
    Route::delete('/server/{id}','ServerController@destroy')->name('deleteserver');

    Route::get('/ad/addad', 'AdController@create')->name('addad');
    Route::post('/ad', 'AdController@store');
    Route::get('/ad/{id}/editad', 'AdController@edit')->name('editad');
    Route::put('/ad/{id}', 'AdController@update');
    Route::delete('/ad/{id}', 'AdController@destroy')->name('deletead');

    Route::get('/website/addwebsite', 'WebsiteController@create')->name('addwebsite');
    Route::post('/website', 'WebsiteController@store');
    Route::get('/website/{id}/editwebsite', 'WebsiteController@edit')->name('editwebsite');
    Route::put('/website/{id}', 'WebsiteController@update');
    Route::delete('/website/{id}', 'WebsiteController@destroy')->name('deletewebsite');
    Route::get('/website/{slug}', 'WebsiteController@show')->name('singlewebsite');

    Route::get('/webmaster', 'WebmasterController@index')->name('webmaster');
    Route::get('/webmaster/addwebmaster','WebmasterController@create')->name('addwebmaster');
    Route::post('/webmaster', 'WebmasterController@store');
    Route::get('/webmaster/{id}/editwebmaster', 'WebmasterController@edit')->name('editwebmaster');
    Route::put('/webmaster/{id}', 'WebmasterController@update');
    Route::delete('/webmaster/{id}', 'WebmasterController@destroy')->name('deletewebmaster');

    //Index
    Route::get('/index-web/{domaing}', 'WebsiteController@refreshIndexWeb')->name('index-web');
    Route::get('/index-image/{domaing}', 'WebsiteController@refreshIndexImage')->name('index-image');
    Route::get('/wordpress-theme/{domaing}', 'WebsiteController@refreshWordpressTheme')->name('wordpress-theme');
    Route::get('/wordpress-post/{domaing}', 'WebsiteController@refreshWordpressPost')->name('wordpress-post');
    Route::get('/wordpress-category/{domaing}', 'WebsiteController@refreshWordpressCategory')->name('wordpress-category');
    Route::get('/wordpress-category-title/{domaing}', 'WebsiteController@refreshWordpressCategoryTitle')->name('wordpress-category-title');
    Route::get('/wordpress-page/{domaing}', 'WebsiteController@refreshWordpressPage')->name('wordpress-page');
    Route::get('/wordpress-page-title/{domaing}', 'WebsiteController@refreshWordpressPageTitle')->name('wordpress-page-title');

    Route::get('/status-index/{domaing}', 'DomainController@refreshStatusIndex')->name('status-index');
    Route::get('/expiration/{domain}', 'DomainController@refreshExpiration')->name('expiration');
    Route::get('/nameserver1/{domain}', 'DomainController@refreshNameServer1')->name('nameserver1');
    Route::get('/nameserver2/{domain}', 'DomainController@refreshNameServer2')->name('nameserver2');
});

// Route::get('/', function () {
//     return view('welcome-copy');
// });


// Route::get('/', function () {
//     if(Auth::check())
//     {
//         return view('welcome');
//     } else {
//         return view('welcome-copy');
//     }
// })->name('dashboard');

Route::get('/', 'WebsiteController@index')->name('dashboard');

Auth::routes();

Route::get('/registrar', 'RegistrarController@index')->name('registrar');
Route::get('/domain', 'DomainController@index')->name('domain');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/server', 'ServerController@index')->name('server');
Route::get('/ad', 'AdController@index')->name('ad');

// Jajal
Route::get('/jajal', function () {
        return view('jajal');
});