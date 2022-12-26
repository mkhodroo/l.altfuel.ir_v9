<?php

namespace App\Providers;

use App\CustomClasses\Access;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $access = new Access();
        $access->CheckClientIP();
        Schema::defaultStringLength(191);
        if(env('APP_ENV') === 'production') {
            \URL::forceScheme('https');
        }
    }
}
