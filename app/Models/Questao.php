<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questao extends Model
{

    use  SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questoes';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alternativas()
    {
        return $this->hasMany(Alternativa::class)->wherePivot('deleted_at', null);
    }
}
