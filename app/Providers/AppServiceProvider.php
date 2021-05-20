<?php

namespace App\Providers;

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
        $this->app->bind('App\Services\Interfaces\UserServiceInterface', 'App\Services\UserService');
        $this->app->bind('App\Services\Interfaces\SearchServiceInterface', 'App\Services\SearchService');
        $this->app->bind('App\Services\Interfaces\TaskServiceInterface', 'App\Services\TaskService');
        $this->app->bind('App\Services\Interfaces\TimesheetServiceInterface', 'App\Services\TimesheetService');
        $this->app->bind('App\Services\Interfaces\FileServiceInterface', 'App\Services\FileService');
        $this->app->bind('App\Services\Interfaces\ReportServiceInterface', 'App\Services\ReportService');
        
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
