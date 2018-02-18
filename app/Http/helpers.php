<?php

function mask($value, $mask)
{
    return vsprintf(str_replace('#', '%s', $mask), str_split($value));
}

if (! function_exists('perfil')) {
    /**
     * Get the available PerfilManager instance.
     *
     * @param  string|null  $driver
     * @return \App\Drivers\Roles\SessionDriver
     */
    function perfil($driver = null)
    {
        return app('perfil')->driver($driver);
    }
}
