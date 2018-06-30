<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(
            'auth.login',
            'App\Http\ViewComposers\LoginComposer'
        );
    }

    public function register()
    {
        //
    }
}
