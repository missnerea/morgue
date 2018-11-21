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
    //return view('morgue.admin.admin_registration');
    //return view('morgue.undertaker.undertaker_home');
    //return view('morgue.admin.undertaker_search');
    //return view('morgue.admin.admin_home');
    //return view('morgue.deceased.current_deceased_view');
    //return view('morgue.deceased.released_deceased_search');
    //return view('morgue.admin.admin_search');
})->name('root');

Route::get('notauth',function(){
    return 'Middleware not authenticated';
})->name('notauth');

/*
Route::get('testtable',function () {
    //return request()->get('table');
    $user=Auth::guard('admin')->user();
    return $user->undertakers()->get();
});
 * 
 */

//Admin Resource controller
Route::group(['prefix'=>'admin_re','as'=>'admin_re.'],function(){
    Route::match(['get','post'],'search',['as'=>'search','uses'=>'AdminResourceController@searchSpecific']);
    Route::get('showsearch',['as'=>'showsearch','uses'=>'AdminResourceController@showSearch']);
    Route::get('{id}/showdelete',['as'=>'showdelete','uses'=>'AdminResourceController@showDelete']);
});

//Undertaker resource controller
Route::group(['prefix'=>'undertaker_re','as'=>'undertaker_re.'],function(){
    Route::match(['get','post'],'search',['as'=>'search','uses'=>'UndertakerResourceController@searchSpecific']);
    Route::get('showsearch',['as'=>'showsearch','uses'=>'UndertakerResourceController@showSearch']);
    Route::get('{id}/showdelete',['as'=>'showdelete','uses'=>'UndertakerResourceController@showDelete']);
    //Route::get('search',['as'=>'search','uses'=>'UndertakerResourceController@searchSpecific']);
});

//Deceased resource controller
Route::group(['prefix'=>'deceased_re','as'=>'deceased_re.'],function(){
    Route::match(['get','post'],'search',['as'=>'search','uses'=>'DeceasedResourceController@searchSpecific']);
    Route::get('showsearch',['as'=>'showsearch','uses'=>'DeceasedResourceController@showSearch']);
    Route::get('{id}/showdelete',['as'=>'showdelete','uses'=>'DeceasedResourceController@showDelete']);
});

//Released Deceased resource controller
Route::group(['prefix'=>'released_deceased_re','as'=>'released_deceased_re.'],function(){
    Route::match(['get','post'],'search',['as'=>'search','uses'=>'ReleasedDeceasedResourceController@searchSpecific']);
    Route::get('showsearch',['as'=>'showsearch','uses'=>'ReleasedDeceasedResourceController@showSearch']);
    Route::get('{id}/showdelete',['as'=>'showdelete','uses'=>'ReleasedDeceasedResourceController@showDelete']);
});

//Admin controller
Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
    Route::post('login',['as'=>'login','uses'=>'AdminController@authenticate']);
    Route::get('logout',['as'=>'logout','uses'=>'AdminController@logout']);
});

//Undertaker controller
Route::group(['prefix' => 'undertaker', 'as' => 'undertaker.'], function() {
    Route::post('login', ['as' => 'login', 'uses' => 'UndertakerController@authenticate']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'UndertakerController@logout']);
});


Route::resource('undertaker_re','UndertakerResourceController');

Route::resource('admin_re','AdminResourceController');

Route::resource('deceased_re','DeceasedResourceController');

Route::resource('released_deceased_re','ReleasedDeceasedResourceController');

Route::post('/',function(){
    return Request::all();
});
