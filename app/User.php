<?php

namespace App;

use App\Models\Perfil;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        parent::deleting(function (User $usuario) {
            $usuario->perfis()->get()->each->delete();
        });

        parent::restoring(function (User $usuario) {
            $usuario->perfis()
                ->onlyTrashed()->get()->each->restore();
        });
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name'];

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
        return $this->name;
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
        return $this->hasMany(Perfil::class, 'usuario_id')->orderBy('tipo');
    }

}
