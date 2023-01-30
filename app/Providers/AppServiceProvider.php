<?php

namespace App\Providers;

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
        $this->app->bind(
            \App\Repositories\AccessTokenCtl\AccessTokenRepositoryInterface::class,
            \App\Repositories\AccessTokenCtl\AccessTokenRepository::class,
        );

        $this->app->bind(
            \App\Repositories\DepartmentApiCtl\DepartmentApiRepositoryInterface::class,
            \App\Repositories\DepartmentApiCtl\DepartmentApiRepository::class
        );

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
