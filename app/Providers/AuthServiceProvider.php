<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isNotALabMember', function($user) {
            return $user->labMembers->where('is_active', 1)->count() <= 0;

        });

        Gate::define('hasPermissionTo', function($user, $permissions) {
            // dump($user->hasAnyPermission(explode('|', $permissions)));
            // return true;
            return $user->hasAnyPermission(explode('|', $permissions));
        });
    }
}
