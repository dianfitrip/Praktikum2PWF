<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
        //
        Gate::define('export-product', function (User $user) {
            return $user->isAdmin();
        });

        Gate::policy(Product::class, ProductPolicy::class);

        Gate::define('manage-category', function (User $user) {
            return strtolower($user->role) === 'admin';
        });
    }
}