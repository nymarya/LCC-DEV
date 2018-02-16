<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpf', 'rg', 'nome',
        'avatar',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        parent::deleting(function (Usuario $usuario) {
            $usuario->perfis()->get()->each->delete();
        });

        parent::restoring(function (Usuario $usuario) {
            $usuario->perfis()
                ->onlyTrashed()->get()->each->restore();
        });
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['nome'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * Get the name for the user.
     *
     * @return string
     */
    public function getNomeAttribute()
    {
        return $this->nome_social ?? $this->nome_civil;
    }

    /**
     * Get the CPF for the user.
     *
     * @return string
     */
    public function getCpfAttribute($value)
    {
        return mask($value, '###.###.###-##');
    }

    /**
     * Get the RG for the user.
     *
     * @return string
     */
    public function getRgAttribute($value)
    {
        return number_format(intval($value), 0, '', '.');
    }

    /**
     * Get the user's avatar url.
     *
     * @param  $value string
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        if (! $value) {
            return url('img/user.png');
        }

        return Storage::url($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perfis()
    {
        return $this->hasMany(Perfil::class)->orderBy('tipo');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
