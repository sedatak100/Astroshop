<?php

namespace App\Providers;

use Darryldecode\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        if (function_exists('config_path')) {
            $this->publishes([
                __DIR__ . '/config/config.php' => config_path('shopping_cart.php'),
            ], 'config');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'shopping_cart');

        $this->app->singleton('cart', function ($app) {
            $storageClass = config('shopping_cart.storage');
            $eventsClass = config('shopping_cart.events');

            $storage = $storageClass ? new $storageClass() : $app['session'];
            $events = $eventsClass ? new $eventsClass() : $app['events'];
            $instanceName = 'cart';

            if (!session()->has('cart_session_id')) {
                session()->put('cart_session_id', 'guest_' . str_random(15));
            }

            $session_key = session()->get('cart_session_id');

            return new Cart(
                $storage,
                $events,
                $instanceName,
                $session_key,
                config('shopping_cart')
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
