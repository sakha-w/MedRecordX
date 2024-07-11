<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('Admin', function (User $user) {
            if ($user->role === 'admin') {
                return $user->role;
            }
        });

        Gate::define('AdminDoctorNurse', function (User $user) {
            if ($user->role === 'admin' || $user->role === 'dokter' || $user->role === 'perawat') {
                return $user->role;
            }
        });

        Gate::define('nurse', function (User $user) {
            if ($user->role === 'admin' || $user->role === 'perawat') {
                return $user->role;
            }
        });

        Gate::define('doctor', function (User $user) {
            if ($user->role === 'admin' || $user->role === 'dokter') {
                return $user->role;
            }
        });

        Gate::define('onlyDoctor', function (User $user) {
            if ($user->role === 'dokter') {
                return $user->role;
            }
        });

    }
}