<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $listen = [
        'Illuminate\Auth\Events\Registered' => [
        'App\Listeners\SendNewUserNotification',
         ],

        Registered::class => [
        SendUserToGoogleSheet::class,
    ],
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
