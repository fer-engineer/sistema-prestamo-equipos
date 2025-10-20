<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Equipo;
use App\Policies\EquipoPolicy;
use App\Models\Prestamo;
use App\Policies\PrestamoPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Equipo::class => EquipoPolicy::class,
        Prestamo::class => PrestamoPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Schema::defaultStringLength(191);

        // Authorization Gates
        Gate::define('manage-system', function (User $user) {
            // Check if the user has a role and if that role's name is 'Administrador'
            return $user->rol && $user->rol->nombre === 'Administrador';
        });

        Gate::define('operate-loans', function (User $user) {
            // Check if the user has a role and if the role is one of the allowed ones
            return $user->rol && in_array($user->rol->nombre, ['Administrador', 'Encargado']);
        });
    }
}