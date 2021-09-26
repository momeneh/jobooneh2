<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\Product;
use App\Policies\MessagePlolicy;
use App\Policies\ProductPolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Product::class => ProductPolicy::class,
        Message::class => MessagePlolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            if(isset(auth()->user()->name)) $name_user = auth()->user()->name;
            else $name_user = $this->app->request['name'];
            return (new MailMessage)->view(
                'emails.verify',compact('url','name_user')
            ) ->subject(__('auth.mail_verify_subject'));
        });
    }
}
