<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\UserServiceInterface;
use App\Services\UserService;
use App\Contracts\AdminServiceInterface;
use App\Services\AdminService;
use App\Contracts\AuthServiceInterface;
use App\Services\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Enregistrer les bindings des interfaces vers leurs implémentations
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}