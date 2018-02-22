<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prova extends Model
{

    use  SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'provas';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'tipo', 'turma_id'
    ];

    public function questoes(){
        return $this->belongsToMany(Questao::class, 'blocos');
    }

    public function turma(){
        return $this->belongsTo(Turma::class);
    }
}
