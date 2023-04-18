<?php

namespace App\Providers;

use App\Services\HubspotNewsletter;
use App\Services\Newsletter;
use HubSpot\Factory;
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

        app()->bind(Newsletter::class, function () {
            $client = Factory::createWithAccessToken(config('hubspot.api_key'));

            return new HubspotNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
