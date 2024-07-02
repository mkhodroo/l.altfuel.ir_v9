<?php

namespace Mkhodroo\Cities;

use Illuminate\Support\ServiceProvider;

class CityProvider extends ServiceProvider
{
    public function register() {

    }

    public function boot() {
        $this->loadMigrationsFrom(__DIR__ . "/Migrations");
        $this->loadRoutesFrom(__DIR__. '/routes.php');;
        $this->loadJsonTranslationsFrom(__DIR__.'/Lang');
    }
}
