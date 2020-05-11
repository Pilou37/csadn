<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('proprietaire', function ($user, $owner) {
            if($user->isOwner($owner) || $user->isAdmin()) {
                    return true;
            } else { return false; }
        });


        Gate::define('edit-user', function ($user, $owner) {
            if($user->isOwner($owner) || $user->isSupervisor($owner)) {
                return true;
            }
            elseif ($user->hasAnyRole(['secretariat','admin']))
            {
                return true;
            }
            else
            {
                return false;
            }
        });


        // ---------------- ACCES ---------------------
        Gate::define('secretariat', function ($user) {
            return $user->hasAnyRole(['secretariat','admin']);
        });

        Gate::define('responsable-section', function ($user) {
            return $user->hasAnyRole(['responsable','secretariat','admin']);
        });

        Gate::define('comptabilite', function ($user) {
            return $user->hasAnyRole(['comptabilite','admin']);
        });

        Gate::define('bureau', function ($user) {
            return $user->hasAnyRole(['comptabilite','secretariat','admin']);
        });

        Gate::define('administrateur', function ($user) {
            return $user->isAdmin();
        });
    }
}
