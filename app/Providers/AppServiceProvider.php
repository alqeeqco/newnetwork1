<?php

namespace App\Providers;

use App\Models\Products;
use App\Models\Settings;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
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
        view()->composer('*',function($view) {
            $view->with('cart',  new CartRepository());
            $view->with('products',  Products::tableFilters()->get());
            $view->with('tax_tax',  Settings::where('key_id' , 'tax')->first()->value);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
