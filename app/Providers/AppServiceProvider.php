<?php

namespace App\Providers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
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
            'includes.menu_bar', 'App\Http\ViewComposers\MasterComposer'
        );
        Validator::extend('recaptcha', 'App\Validators\ReCaptcha@validate');

//        DB::listen(function ($query) {
//            Log::debug($query->sql);
//        });
    }
}
