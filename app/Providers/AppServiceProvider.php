<?php

namespace App\Providers;

use App\Lib\Blade\Extension;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Extension::extendBlade();

        View::composer('*', function ($view) {
            View::share('__view', (object) ['name' => $view->getname()]);
            $view->with('__self', (object) ['name' => $view->getname()]);
        });

    }
}
