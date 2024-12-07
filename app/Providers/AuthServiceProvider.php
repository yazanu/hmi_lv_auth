<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Gate;
use App\Policies\ProductPolicy;
use App\Models\Product;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user){
            return $user->role == 'admin';
        });

        Gate::define('isManager', function($user){
            return $user->role == 'manager';
        });

        Gate::define('isUser', function($user){
            return $user->role == 'user';
        });
    }
}
