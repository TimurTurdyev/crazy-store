<?php

namespace App\Providers;

use App\Repositories\OrderInterface;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentInterface;
use App\Repositories\PaymentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
//        CategoryContract::class => CategoryRepository::class,
//        AttributeContract::class => AttributeRepository::class,
//        BrandContract::class => BrandRepository::class,
//        ProductContract::class => ProductRepository::class,
        OrderInterface::class => OrderRepository::class,
        PaymentInterface::class => PaymentRepository::class,
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
