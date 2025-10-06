<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
{
    View::composer('*', function ($view) {
        if (Auth::check()) {
            // $user = Auth::user();
            // $followingCount = $user->followings()->count();
            // $followerCount = $user->followed()->count();

            $view->with('user', Auth::user())
                ->with('followingCount', Auth::user()->followings()->count())
                ->with('followerCount', Auth::user()->followed()->count());
        }
    });
}
}
