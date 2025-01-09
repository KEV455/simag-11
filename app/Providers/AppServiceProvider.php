<?php

namespace App\Providers;

use App\Models\TahunAjaran;
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
        // View Composer untuk partials.navbar
        View::composer('layouts.partials.base-navbar', function ($view) {
            $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();
            $view->with('tahun_ajaran_aktif', $tahun_ajaran_aktif);
        });
    }
}
