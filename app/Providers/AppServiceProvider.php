<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Group;
use App\Models\OrderItem;
use App\Models\Product;
use App\Observers\OrderItemObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Relation::morphMap([
            'category' => Category::class,
            'brand' => Brand::class,
            'group' => Group::class,
            'product' => Product::class,
        ]);
    }
}
