<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Kandidat;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


public function boot(): void
{
    View::composer('components.sidebar', function ($view) {
        $user = Auth::user();

        $myKandidat = $user && $user->kandidat
            ? $user->kandidat
            : null;

        $view->with('myKandidat', $myKandidat);
    });
}

}
