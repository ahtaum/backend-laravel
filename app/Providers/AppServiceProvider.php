<?php

namespace App\Providers;

use App\Repository\Cars\CarRepository;
use App\Repository\Cars\CarRepositoryInterface;
use App\Repository\Motor\MotorRepository;
use App\Repository\Motor\MotorRepositoryInterface;
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
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
        $this->app->bind(MotorRepositoryInterface::class, MotorRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
