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
     * Bootstrap any application services. UCP1
     */
    public function boot(): void
    {
        // Membuat kunci gembok (Gate) bernama 'manage-category'
        // Logikanya: Gate akan terbuka (true) JIKA user yang sedang login memiliki role 'admin'
        Gate::define('manage-category', function (User $user) {
            return $user->role === 'admin'; 
        });
    }
}