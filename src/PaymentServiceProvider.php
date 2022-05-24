<?php

namespace Khaleds\Payment;

use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

       $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../config/khaledsPayment.php' => config_path('khaledsPayment.php'),
            ], 'config');

        }
    //    $this->loadMigrationsFrom(__DIR__.'/database/migrations');
//        $this->loadViewsFrom(__DIR__.'/views','product');

    }
}
