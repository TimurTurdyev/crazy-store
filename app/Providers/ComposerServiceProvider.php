<?php

namespace App\Providers;

use App\Http\ViewComposers\NavigationComposer;
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
    }
}
