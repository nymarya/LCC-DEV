<?php

namespace App\Models\Roles;

use App\Models\Nota;
use App\Models\Traits\Papel;
use App\Models\Turma;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model
{
    use Papel, SoftDeletes;

    /**
     * Role's verbose name.
     *
     * @var string
     */
    public $verbose = 'Aluno';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alunos';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'turmas_alunos', 'aluno_id', 'turma_id');
    }

    public function notas(){
        return $this->hasMany(Nota::class);
    }
}
