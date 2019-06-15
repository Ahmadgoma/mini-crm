<?php

namespace App\Providers;


use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\CompanyRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
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
