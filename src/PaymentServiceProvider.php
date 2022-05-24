<?php

namespace Khaleds\Payment;

use Illuminate\Support\ServiceProvider;
use Khaleds\Payment\Factories\PaymentFactory;
use Khaleds\Payment\Services\FawryPlusPaymentService;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // register the factory as singleton
        $this->app->singleton(PaymentFactory::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
     
        // register payment methods to array of the singleton class 
        $this->app->make(PaymentFactory::class)
            ->register("fawry", new FawryPlusPaymentService(
                config('khaledsPayment.merchant_code'),
                (config('khaledsPayment.debug'))?
                    config('khaledsPayment.testing_uri'):
                    config('khaledsPayment.pr_uri'),
                    config('khaledsPayment.security_key')
            ))
        ->register("book", new FawryPlusPaymentService(
            config('khaledsPayment.merchant_code'),
            (config('khaledsPayment.debug'))?
                config('khaledsPayment.testing_uri'):
                config('khaledsPayment.pr_uri'),
                config('khaledsPayment.security_key')
                
        ))
        ;

       $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../config/khaledsPayment.php' => config_path('khaledsPayment.php'),
            ], 'config');

        }
    //    $this->loadMigrationsFrom(__DIR__.'/database/migrations');

    }
}