<?php

namespace App\Providers;

use App\Models\Carts;
use App\Observers\CartObserver;
use App\Repositories\Cart\CartInterface;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartInterface::class, function() {
            return new CartRepository();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Carts::observe(CartObserver::class);
    }
}
