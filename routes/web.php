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
Route::get('page/{id}', 'Dashboard\PageController@show')->name('pages.show');

Auth::routes(['verify' => true]);



//--------------------Normal Users------------------------------
/*dashboard*/ Route::get('/home', 'UserController@dashboard')->name('dashboard')->middleware('verified');
Route::group( ['middleware' => 'auth'],function (){
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::group(['middleware' => 'verified'], function () {
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'Dashboard\ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'Dashboard\ProfileController@update']);
        Route::get('profile/password', ['as' => 'profile.change_password', 'uses' => 'Dashboard\ProfileController@change_password']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'Dashboard\ProfileController@password']);
        Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'Dashboard\PageController@notifications']);
        Route::resource('/userProduct','Dashboard\ProductController');
        Route::post('/upload','Dashboard\ProductController@UploadFile')->name('upload_file_user_product');
        Route::post('/remove','Dashboard\ProductController@RemoveFile')->name('remove_file_user_product');
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
        Route::resource('/product_category','Admin\ProductCategoryController');
        Route::get('/','Admin\AdminController@index')->name('admin.dashboard');
        Route::resource('user', 'Admin\UserController', ['except' => ['create','store']]);
        Route::resource('/product','Admin\ProductController');
        Route::post('/upload','Admin\ProductController@UploadFile')->name('upload_file_product');
        Route::post('/remove','Admin\ProductController@RemoveFile')->name('remove_file_product');
        Route::get('notification','Admin\NotificationController@index')->name('admin.notifications');
        Route::group(['prefix'=>'notification'],function (){
            Route::get('','Admin\NotificationController@index')->name('admin.notifications');
            Route::delete('{id}','Admin\NotificationController@destroy')->name('admin.delete_notifications');
            Route::get('delete_all','Admin\NotificationController@destroy_all')->name('admin.destroy_notifications');

        });
    });
});


Route::get('/test', function (){
    return view('emails.user_create_product');
});
Route::group(['middleware' => 'verified'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'Dashboard\PageController@icons']);
//		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
//		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
//		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
//		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
});

Route::get('search/autocompleteUsers', 'UserController@autocomplete')->name('autocompleteUsers');
