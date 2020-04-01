<?php

namespace App\Providers;

use App\Cliente;
use App\Repos\BuilderRepoInterface\OrderRepoBuilderInterface;
use App\Repos\OrderRepo;
use App\Repos\RepoBuilders\OrderRepoBuilder;
use App\Repos\RepoInterfaces\OrderRepoInterface;
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
        $this->app->bind(OrderRepoBuilderInterface::class, function($app){
            $request = app(\Illuminate\Http\Request::class);
            return new OrderRepoBuilder($request);
        });
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
