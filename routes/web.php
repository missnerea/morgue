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

Route::get('/', function () {
    return view('morgue.login.login');
})->name('root');

Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
    Route::post('login',['as'=>'login','uses'=>'AdminController@authenticate']);
    Route::get('logout',['as'=>'logout','uses'=>'AdminController@logout']);
});

Route::group(['prefix' => 'undertaker', 'as' => 'undertaker.'], function() {
    Route::post('login', ['as' => 'login', 'uses' => 'UndertakerController@authenticate']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'UndertakerController@logout']);
});

Route::resource('undertaker_re','UndertakerResourceController');

Route::resource('admin_re','AdminResourceController');

Route::post('/',function(){
    return Request::all();
});
