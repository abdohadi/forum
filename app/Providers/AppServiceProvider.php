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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // this is better than View::share because it threw an error when running tests
        \View::composer('*', function ($view) {
            $view->with('channels', \App\Models\Channel::all());
        });
        // \View::share('channels', \App\Models\Channel::all());
    }
}
