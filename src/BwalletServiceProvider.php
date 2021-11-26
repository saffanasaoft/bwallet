<?php

namespace Digitcode\Bwallet;

use Digitcode\Bwallet\Commands\TopupCommand;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class BwalletServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/bwallet.php' => config_path('bwallet.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                TopupCommand::class,
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/bwallet.php', 'bwallet');

        $this->app->bind(BwalletClient::class, function () {
            $client = new Client();
            return new BwalletClient($client);
        });

        $this->app->bind(BwalletWrapper::class, function () {
            $client = app(BwalletClient::class);
            return new BwalletWrapper($client);
        });

        $this->app->alias(BwalletWrapper::class, 'bwallet');
    }

}