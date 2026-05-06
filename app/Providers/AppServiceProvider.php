<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();

        \Illuminate\Support\Facades\Gate::define('manage-master', function ($user) {
            return $user->role === 'admin';
        });

        \Illuminate\Support\Facades\Gate::define('approve-po', function ($user) {
            return in_array($user->role, ['admin', 'kepala']);
        });

        \Illuminate\Support\Facades\Gate::define('receive-po', function ($user) {
            return in_array($user->role, ['admin', 'petugas']);
        });

        \Illuminate\Support\Facades\Gate::define('lihat-laporan', function ($user) {
            return in_array($user->role, ['admin', 'kepala']);
        });
    }
}
