<?php

namespace App\Providers;

use App\Http\ViewComposers\NavigationComposer;
use App\Repositories\CartInterface;
use App\Repositories\CartRepository;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        view()->composer('catalog.partials.menu', NavigationComposer::class);
        view()->composer('catalog.navbar', function($view) {
            return $view->with('cart_count', $this->app->make(CartInterface::class)->getCount());
        });
    }
}
