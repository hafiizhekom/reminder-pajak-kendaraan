<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        // Gate::define('view-users', function ($user) {
        //     return $user->id === 2
        //         ? Response::allow()
        //         : Response::deny('You must be a super administrator.');
        // });

        // Gate::define('view-users', 'App\Policies\UserPolicy@view');
    }
}
