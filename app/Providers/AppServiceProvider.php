<?php

namespace App\Providers;

use App\Http\Controllers\BasketContract;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\TmpBasketController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        $this->app->singleton(BasketContract::class,function (){
            dd(auth()->id(),'app');
            if(empty(auth()->id())) return new TmpBasketController();
            return new BasketController();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
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
