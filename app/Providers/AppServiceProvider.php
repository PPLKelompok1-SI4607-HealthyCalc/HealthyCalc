<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use Illuminate\Support\ServiceProvider;


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
        Carbon::setLocale('id');
        Paginator::useBootstrapFive();
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userProfile = UserProfile::where('user_id', Auth::id())->first();
                $view->with('userProfile', $userProfile);
            }
        });
    }
}
