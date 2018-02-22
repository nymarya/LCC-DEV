<?php

namespace App\Models;

use App\Models\Roles\Aluno;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aluno_id', 'prova_id', 'nota',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prova()
    {
        return $this->belongsTo(Prova::class);
    }
}
