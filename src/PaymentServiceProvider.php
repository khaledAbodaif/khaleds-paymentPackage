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
        //
        $this->app->singleton(PaymentFactory::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make(PaymentFactory::class)
            ->register("fawry", new FawryPlusPaymentService(
                config('khaledsPayment.merchant_code'),
                (config('khaledsPayment.debug'))?
                    config('khaledsPayment.testing_uri'):
                    config('khaledsPayment.pr_uri')
            ))
        ->register("book", new FawryPlusPaymentService(
            config('khaledsPayment.merchant_code'),
            (config('khaledsPayment.debug'))?
                config('khaledsPayment.testing_uri'):
                config('khaledsPayment.pr_uri')
        ))
        ;

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
