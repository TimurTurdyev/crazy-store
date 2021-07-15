<?php

namespace App\Providers;

use App\Contracts\OrderContract;
use App\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
//        CategoryContract::class => CategoryRepository::class,
//        AttributeContract::class => AttributeRepository::class,
//        BrandContract::class => BrandRepository::class,
//        ProductContract::class => ProductRepository::class,
        OrderContract::class => OrderRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
