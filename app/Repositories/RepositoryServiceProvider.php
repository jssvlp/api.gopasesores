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
            'App\Repositories\Interfaces\PermissionRepositoryInterface',
            'App\Repositories\PermissionRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\RoleRepositoryInterface',
            'App\Repositories\RoleRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\InsuranceRepositoryInterface',
            'App\Repositories\InsuranceRepository'
        );
    }
}
