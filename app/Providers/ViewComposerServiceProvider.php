<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('pages.*', \App\Http\ViewComposers\NewsComposer::class);
        View::composer('users.*', \App\Http\ViewComposers\NewsComposer::class);
        View::composer('*', function ($view)  {
            $view->with('auth_user', auth()->user());
        });
    }
}
