<?php


namespace App\Repositories;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\IClientRepository',
            'App\Repositories\ClientRepository');

        $this->app->bind(
            'App\Repositories\Interfaces\IUserRepository',
            'App\Repositories\UserRepository');

        $this->app->bind(
            'App\Repositories\Interfaces\IEmployeeRepository',
            'App\Repositories\EmployeeRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\IFileRepository',
            'App\Repositories\FileRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\IPermissionRepository',
            'App\Repositories\PermissionRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\IRoleRepository',
            'App\Repositories\RoleRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\IInsuranceRepository',
            'App\Repositories\InsuranceRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\IPolicyRepository',
            'App\Repositories\PolicyRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\IStatisticsRepository',
            'App\Repositories\StatisticsRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\IBranchRepository',
            'App\Repositories\BranchRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ISinisterRepository',
            'App\Repositories\SinisterRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\IPolicyPaymentRepository',
            'App\Repositories\PolicyPaymentRepository'
        );
    }
}
