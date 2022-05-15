<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        $repositories = [
            'User\UserRepositoryInterface' => 'User\UserRepository',
            'Department\DepartmentRepositoryInterface' => 'Department\DepartmentRepository',
            'Classes\ClassesRepositoryInterface' => 'Classes\ClassesRepository',
            'Schedules\SchedulesRepositoryInterface' => 'Schedules\SchedulesRepository',
            'Role\RoleRepositoryInterface' => 'Role\RoleRepository'
        ];

        foreach ($repositories as $key => $val) {
            $this->app->bind("App\\Repositories\\$key", "App\\Repositories\\$val");
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }

}
