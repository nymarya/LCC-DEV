<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alternativa extends Model
{

    use  SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alternativas';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'questao_id', 'alternativa', 'correta'
    ];
}
