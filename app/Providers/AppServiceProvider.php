<?php

namespace App\Providers;

use App\Fatturazione\Acube;
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
        if(true){ // auth è un super admin
            $this->app->singleton(Acube::class, function($app){
                return new Acube($app->auth->user());
            });
        }
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
