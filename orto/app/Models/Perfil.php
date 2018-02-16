<?php

namespace App\Models;

use OwenIt\Auditing\Auditable;
use App\Scopes\InstituicaoScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Perfil extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perfis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo', 'usuario_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function papel()
    {

        if (empty($class = $this->tipo)) {
            return $this->morphTo(null, 'tipo', 'id')
                ->withoutGlobalScopes();
        }

        return $this->hasOne($this->getActualClassNameForMorph($class), 'id')
            ->withoutGlobalScopes();
    }

}
