<?php

namespace Khaleds\Payment;

use Illuminate\Support\ServiceProvider;

class PaymentProvider extends ServiceProvider
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
//        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
//        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
//        $this->loadViewsFrom(__DIR__.'/views','product');

    }
}
