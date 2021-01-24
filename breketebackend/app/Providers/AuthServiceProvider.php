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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        //edit rules
        Gate::define('admin', function ($user) {
            return $user->hasRole('Admin');
        });

        //full access rules
        Gate::define('total-control', function ($user) {
            return $user->hasRole('SuperAdmin');
        });

        //manage users rules
        Gate::define('manage-users', function ($user) {
            return $user->hasAnyRoles(['SuperAdmin', 'Admin']);
        });

        //view awaiting complaints rules
        Gate::define('awaiting', function ($user) {
            return $user->hasAnyRoles(['SuperAdmin', 'Admin', 'ComplaintAttendant']);
        });

        //resolve complaints rules
        Gate::define('resolve', function ($user) {
            return $user->hasAnyRoles(['SuperAdmin', 'Admin', 'ResolutionAttendant']);
        });

        //view all complaints rules
        Gate::define('view_all_complaints', function ($user) {
            return $user->hasAnyRoles(['SuperAdmin', 'Admin', 'ComplaintAttendant', 'ResolutionAttendant']);
        });

        //active user rules
        Gate::define('status', function ($user) {
            return $user->isActive(['suspended']);
        });

        Gate::define('complaint_view', function ($user) {
            return $user->hasRole('ComplaintAttendant');
        });

        Gate::define('resolve_view', function ($user) {
            return $user->hasRole('ResolutionAttendant');
        });
        /**
         * Admin privilages end
         */
    }
}
