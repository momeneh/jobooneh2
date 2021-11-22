<?php

namespace App\Providers;

use App\Http\Controllers\BasketContract;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\TmpBasketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $file = app_path('Helpers/Helper.php');
        if (file_exists($file)) {
            require_once($file);
        }
        $this->app->call([$this, 'RegisterBasket']);

    }

    public function RegisterBasket(Request $request){
        $this->app->bind(BasketContract::class, function ($app) use ($request) {

            if (!empty($request->user('web'))) return $app->make(BasketController::class);
            else return $app->make(TmpBasketController::class);

        });
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Schema::defaultStringLength(191);
        View::composer(
            'layouts.green_layout', 'App\Http\ViewComposers\MasterComposer'
        );
        View::composer(
        'message.*','App\Http\ViewComposers\MessageComposer'
         );
        Validator::extend('recaptcha', 'App\Validators\ReCaptcha@validate');

//        DB::listen(function ($query) {
//            Log::debug($query->sql);
//            Log::debug($query->bindings);
//        });
    }
}
