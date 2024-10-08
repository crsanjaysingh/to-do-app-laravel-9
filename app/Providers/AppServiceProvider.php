<?php

namespace App\Providers;
use Inertia\Inertia;


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
        Inertia::share('appName', config('app.name'));

        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });
    }
}
