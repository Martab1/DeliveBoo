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
                    'publicKey' => 'tcdwykkhr2dv6k58',
                    'privateKey' => '69f8d7f9cbfd2ca963199c4bd205ded7'
                ]
            );
        });
    }
}
