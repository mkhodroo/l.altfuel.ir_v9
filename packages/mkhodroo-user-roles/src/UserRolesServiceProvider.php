<?php 

namespace Mkhodroo\UserRoles;

use Illuminate\Support\ServiceProvider;

class UserRolesServiceProvider extends ServiceProvider
{
    public function register() {
        
    }

    public function boot() {
        $this->loadMigrationsFrom(__DIR__ . "/migrations");
        $this->loadRoutesFrom(__DIR__. '/routes.php');;
        $this->loadViewsFrom(__DIR__. '/Views', 'URPackageView');
    }
}