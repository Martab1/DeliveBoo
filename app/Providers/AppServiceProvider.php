<?php

namespace App\Providers;

use Braintree\Gateway;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'rdnzkt3fvw8sy2vq',
                    'publicKey' => 'ptqyp7pr3t3hv73b',
                    'privateKey' => '1a7b517db95c9a61144196bcde1205d0'
                ]
            );
        });
    }
}
