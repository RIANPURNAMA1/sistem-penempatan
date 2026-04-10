<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL; // <--- Penting agar URL bisa dikenali

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
        // View Composer untuk Sidebar
        View::composer('components.sidebar', function ($view) {
            $user = Auth::user();

            $myKandidat = $user && $user->kandidat
                ? $user->kandidat
                : null;

            $view->with('myKandidat', $myKandidat);
        });

        // Force HTTPS di lingkungan non-local (VPS/Production)
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}