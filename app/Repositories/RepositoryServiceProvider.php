<?php


namespace App\Repositories;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\ClientRepositoryInterface',
            'App\Repositories\ClientRepository');

        $this->app->bind(
            'App\Repositories\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository');

        $this->app->bind(
            'App\Repositories\Interfaces\EmployeeRepositoryInterface',
            'App\Repositories\EmployeeRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\FileRepositoryInterface',
            'App\Repositories\FileRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\RepositoryInterface',
            'App\Repositories\PermissionRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\RepositoryInterface',
            'App\Repositories\RoleRepository'
        );
    }
}
