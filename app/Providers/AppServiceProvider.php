<?php

namespace App\Providers;

use App\Helper\AuthApi;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Schema;

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
        Schema::defaultStringLength(191);

        if(env('APP_ENV') !== 'local')
        {
            URL::forceScheme('https');
        }

//        \Illuminate\Pagination\Paginator::useBootstrap();

    }
}
