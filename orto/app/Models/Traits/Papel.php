<?php

namespace App\Models\Traits;

trait Papel
{
    /**
     * Boot the Papel trait for a model.
     *
     * @return void
     */
    public static function bootPapel()
    {
        static::deleting(function ($papel) {
            $papel->perfil()->get()->each->delete();
        });

        static::restoring(function ($papel) {
            $papel->perfil()
                ->withTrashed()->get()->each->restore();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function perfil()
    {
        return $this->morphOne(\App\Models\Perfil::class, 'papel', 'tipo', 'id');
    }
}
