<?php

namespace App\Providers;

use App\Cliente;
use App\Repos\OrderRepo;
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
        $this->app->bind(OrderRepoInterface::class, function($app){
            $request = app(\Illuminate\Http\Request::class);
            $user = $request->user();
            $customer = Cliente::byEmail($user->email);
            return new OrderRepo($customer,$user);
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
