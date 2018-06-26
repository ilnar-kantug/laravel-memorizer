<?php

namespace App\Providers;

use App\Entity\Pack;
use App\Entity\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerPermissions();
    }

    private function registerPermissions()
    {
        Gate::define('show-pack', function (User $user, Pack $pack) {
            return $user->isAdmin() || $user->isModerator() || $pack->user_id === $user->id;
        });
    }
}
