<?php

namespace App\Models\Roles;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Papel extends Model
{
    protected $table = 'papeis';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usuarios()
    {
        return $this->setKeyName('slug')->belongsToMany(
            User::class, 'perfis',
            'tipo', 'usuario_id'
        )->wherePivot('deleted_at', null);
    }
}
