<?php

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

Route::get('/', 'MainPageController@index')->name('MainPage');
Route::get('lang/{locale}', 'LangController@lang')->name('lang');
Route::get('page/{id}', 'PageController@show')->name('pages.show');

Auth::routes(['verify' => true]);


/*dashboard*/ Route::get('/home', 'UserController@dashboard')->name('dashboard')->middleware('verified');

//--------------------Normal Users------------------------------
Route::group( ['middleware' => 'auth'],function (){
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::group(['middleware' => 'verified'], function () {
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
        Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
    });
});



//--------------------Admins------------------------------
Route::group(['prefix'=>'admin'],function (){
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::group(['middleware' => 'auth:admin'],function (){
        Route::resource('/menu','Admin\MenuController');
        Route::resource('/link_locations','Admin\LinkLocationsController');
        Route::resource('/link','Admin\LinkController');
        Route::resource('/page','Admin\PageController');
        Route::get('/','Admin\AdminController@index')->name('admin.dashboard');
        Route::resource('user', 'UserController', ['except' => ['show']]);

    });
});


//Route::get('/test', function () {
//    return view('emails.verify');
//});
Route::group(['middleware' => 'verified'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
//		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
//		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
//		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
//		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
});
