<?php

namespace App\Providers;

use App\Repositories\CartRepository;
use App\Repositories\CartInterface;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    protected bool $defer = true;
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
