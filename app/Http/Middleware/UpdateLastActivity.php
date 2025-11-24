<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class UpdateLastActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            User::where('id', Auth::id())->update([
                'last_activity' => now(),
            ]);
        }


        return $next($request);
    }
}
