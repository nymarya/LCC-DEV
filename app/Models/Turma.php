<?php

namespace App\Models;

use App\Models\Roles\Aluno;
use App\Models\Roles\Professor;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'turmas_alunos', 'turma_id', 'aluno_id')->wherePivot('deleted_at', null);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function professores()
    {
        return $this->belongsToMany(Professor::class, 'turmas_professores', 'turma_id', 'professor_id')->wherePivot('deleted_at', null);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provas()
    {
        return $this->hasMany(Prova::class);
    }
}
