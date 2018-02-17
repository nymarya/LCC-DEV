<?php

namespace App\Providers;

use App\Managers\RolesManager;
use App\Models\Roles\Paciente;
use App\Models\Roles\Administrador;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'administrador' => Administrador::class,
            'paciente' => Paciente::class,
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('perfil', function ($app) {
            return new RolesManager($app);
        });
    }
}
