<?php

namespace App\Models;

use App\Assunto;
use Illuminate\Database\Eloquent\Model;

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

    public function assuntos(){
        $this->hasManyThrough(Assunto::class, Bloco::class);
    }
}
