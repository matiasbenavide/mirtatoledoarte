<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);

        View::composer('includes.sidebar', function ($view) {
            // $view->with([
            //     'tasks_menu' => TaskUserRepository::getAllTasksAdminMenuFromAuthUser(),
            //     'type_tasks' => TypeTaskRepository::getBackofficeTypeTasks(),
            // ]);
        });
    }
}
