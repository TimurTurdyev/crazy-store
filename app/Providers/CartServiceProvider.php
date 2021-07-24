<?php

namespace App\Providers;

use App\Repositories\CartRepository;
use App\Repositories\CartInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(CartInterface::class, CartRepository::class);
    }
}
