<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('admin-routes', function($user) {
            if ($user->role === 'admin') {
                return $user;
            }
        });

        Gate::define('teacher-routes', function($user) {
            if ($user->role == 'teacher') {
                return $user;
            }
        });

        Gate::define('user-routes', function($user) {
            if ($user->role == 'user') {
                return $user;
            }
        });
    }
}
