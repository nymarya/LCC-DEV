<?php

namespace App\Models\Roles;

use App\Models\PlanoSaude;
use App\Models\Vinculo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Papel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use Papel, SoftDeletes;

    /**
     * Role's verbose name.
     *
     * @var string
     */
    public $verbose = 'Paciente';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pacientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registro',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    public function vinculos()
    {
        $this->hasMany(Vinculo::class, 'paciente_id');
    }

}
