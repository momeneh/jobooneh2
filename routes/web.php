<?php

use App\Notifications\OrderCreated;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;
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
Route::get('/homePage', 'MainPageController@index')->name('mainPage');
Route::post('/homePage', 'MainPageController@subscribe')->name('subscribe');
Route::get('lang/{locale}', 'LangController@lang')->name('lang');
Route::get('page/{id}', 'Dashboard\PageController@show')->name('pages.show');
Route::get('contact_us/', 'ContactController@contact_form')->name('pages.contact_form');
Route::post('contact_us/', 'ContactController@contact_us')->name('pages.contact_us');
Route::get('categories/', 'ProductController@categories')->name('pages.categories');
Route::get('categories/{id}', 'ProductController@cat_products')->name('pages.cat_products');
Route::get('product/{id}', 'ProductController@show')->name('pages.product');
Route::get('productOwner/{id}', 'ProductController@owner')->name('pages.owner');
Route::post('comment_store/', 'ProductController@commentStore')->name('comment.store');
Route::post('product/', 'ProductController@rateStore')->name('pages.productRate');
Route::get('search/', 'ProductController@search')->name('pages.search');
Route::get('search/filters', 'ProductController@filters')->name('pages.search.filters');
Route::resource('/basket','basket\ParentBasketController');

Auth::routes(['verify' => true]);

Route::get('search/autocompleteUsers', 'UserController@autocomplete')->name('autocompleteUsers');
//Route::get('artisan', function() {
//    Artisan::call('migrate '  );
//    Artisan::call('db:seed '  );
//});
//Route::get('/test', function (){
//$order  = \App\Models\Order::find(3)->load('Items.products.images');//dd($order);
//    return view('emails.order_tracking_notify',['order'=>$order,'receiver'=>'hygy','shopper'=>'fxgbfxg','body_desc'=> 'jashfzsufy usd ']);
//});
//Route::get('/rl',function (){
//    \Illuminate\Support\Facades\Artisan::call('route:list');
//    dd(\Illuminate\Support\Facades\Artisan::output());
//
//});

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
        Route::post('/newsletter_upload', 'Admin\SubscribeController@UploadFile')->name('admin.upload_file_newsletter');
        Route::post('/upload','Admin\ProductController@UploadFile')->name('upload_file_product');
        Route::post('/remove','Admin\ProductController@RemoveFile')->name('remove_file_product');
        Route::name('admin.')->group(function () {
            Route::resource('/message', 'MessageController', ['as', 'admin']);
        });
        Route::get('/message_Receiver', 'MessageController@autocomplete')->name('admin.autocompleteReceiver');
        Route::post('/message_upload', 'MessageController@upload')->name('admin.upload_file_message');
        Route::post('/message_remove', 'MessageController@remove')->name('admin.remove_file_message');
        Route::get('/attachment_view/{name_file}', 'MessageController@show_attachments')->name('admin.show_attachments');
        Route::get('/message_sent', 'MessageController@SentMessages')->name('admin.message_sent');
        Route::get('/message_reply/{id}', 'MessageController@ReplyMessages')->name('admin.message_reply');
        Route::get('/contacts','ContactController@index')->name('admin.contacts');
        Route::get('/contacts/{id}','ContactController@show')->name('admin.show_contacts');
        Route::resource('/comment','Admin\CommentController')->except('store');
        Route::resource('/subscribe','Admin\SubscribeController');
        Route::get('/subscribe_excel/{id}','Admin\SubscribeController@receivers')->name('subscribe_excel');
        Route::get('/subscribe_send/{id}','Admin\SubscribeController@send')->name('subscribe_send');
        Route::group(['prefix'=>'notification'],function (){
            Route::get('','Admin\NotificationController@index')->name('admin.notifications');
            Route::delete('{id}','Admin\NotificationController@destroy')->name('admin.delete_notifications');
            Route::get('delete_all','Admin\NotificationController@destroy_all')->name('admin.destroy_notifications');
            Route::post('user','Admin\NotificationController@notify_user')->name('admin.notify_user');

        });
    });
});

//--------------------Normal Users------------------------------
/*dashboard*/ Route::get('/home', 'UserController@dashboard')->name('dashboard')->middleware('verified');
Route::group( ['middleware' => 'auth'],function (){
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout.a');
    Route::group(['middleware' => 'verified'], function () {
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'Dashboard\ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'Dashboard\ProfileController@update']);
        Route::get('profile/password', ['as' => 'profile.change_password', 'uses' => 'Dashboard\ProfileController@change_password']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'Dashboard\ProfileController@password']);
        Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'Dashboard\PageController@notifications']);
        Route::delete('notifications/{id}','Dashboard\PageController@destroyNotifications')->name('delete_notifications');
        Route::get('notifications/delete_all','Dashboard\PageController@destroyAllNotifications')->name('destroy_notifications');
        Route::resource('/userProduct','Dashboard\ProductController');
        Route::get('/productCountLog/{id}',function ($id){
            if(\Illuminate\Support\Facades\Storage::exists('product_count_logs/'.$id.'.txt'))
                return \Illuminate\Support\Facades\Storage::download('product_count_logs/'.$id.'.txt');
            else abort(404);
        })->name('productCountLog');
        Route::post('/upload','Dashboard\ProductController@UploadFile')->name('upload_file_user_product');
        Route::post('/remove','Dashboard\ProductController@RemoveFile')->name('remove_file_user_product');
        Route::resource('/message','MessageController');
        Route::get('/message_Receiver', 'MessageController@autocomplete')->name('autocompleteReceiver');
        Route::post('/message_upload', 'MessageController@upload')->name('upload_file_message');
        Route::post('/message_remove', 'MessageController@remove')->name('remove_file_message');
        Route::get('/message_sent', 'MessageController@SentMessages')->name('message_sent');
        Route::get('/message_reply/{id}', 'MessageController@ReplyMessages')->name('message_reply');
        Route::get('/attachment_view/{name_file}', 'MessageController@show_attachments')->name('show_attachments');
        Route::post('/shop', 'OrderController@create')->name('shop');
        Route::resource('/order','OrderController')->except(['edit','update']);
        Route::get('/confirm_order/{id}','OrderController@confirm')->name('confirm_order');
        Route::get('/problem_order/{id}','OrderController@problem')->name('order_problem');
    });
});

//-------------------Normal Users And Admins-------------------------
Route::group( ['middleware' => 'auth:web,admin'],function (){
    Route::get('/requested_orders','OrderController@requested')->name('requested_orders');
    Route::get('/order/{id}/edit', 'OrderController@edit')->name('order_edit');
    Route::put('/order/{id}/edit',  'OrderController@update')->name('order_update');
    Route::post('/order/desc',  'OrderController@problem_desc')->name('order_desc');
    Route::get('/receipt_images/{name_file}','OrderController@receipt');
});


