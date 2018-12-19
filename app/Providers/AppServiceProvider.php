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
        $this->app->singleton('file_manage', function ($app) {
            $disk_config = config('filesystems.default', 'public');
            # TODO 第三方存储  默认 public=>local
            if ($disk_config === 'oss') {
                return new \App\Tools\FileManage\QiniuManage();
            }
            if ($disk_config === 'qiniu') {
                return new \App\Tools\FileManage\QiniuManage();
            }

            return new \App\Tools\FileManage\BaseFileManage();
        });
    }
}
