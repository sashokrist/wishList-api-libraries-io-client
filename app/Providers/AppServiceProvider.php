<?php

namespace App\Providers;

use App\Services\RegistrationService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RegistrationService::class, function ($app) {
            $client = new Client([
                'base_uri' => 'http://wishlist.test'
            ]);

            return new RegistrationService($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
