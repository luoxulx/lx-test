<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // to fixed mysql 5.5
        Schema::defaultStringLength(191);
        // to share the common data for the blade templates
        view()->composer('*', 'App\Http\Controllers\Front\HomeController@common_data');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
