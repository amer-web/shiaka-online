<?php

namespace App\Providers;

use App\Http\Eloquent\OrderRepository;
use App\Http\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(OrderRepositoryInterface::class,OrderRepository::class);
    }
}
