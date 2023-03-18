<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Cart\Contracts\CartInterface;
use App\Cart\Cart;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CartInterface::class, function() {

            return new Cart(session());

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       //
    }
}
