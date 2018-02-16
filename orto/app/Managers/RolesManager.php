<?php

namespace App\Managers;

use Illuminate\Support\Manager;
use App\Drivers\Roles\SessionDriver;

class RolesManager extends Manager
{
    /**
     * Create an instance of the session driver.
     *
     * @return \App\Drivers\Roles\SessionDriver
     */
    protected function createSessionDriver()
    {
        return new SessionDriver(
            $this->app->make('auth.driver'),
            $this->app->make('session.store'),
            $this->app->make('request')
        );
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'session';
    }
}
