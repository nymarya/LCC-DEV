<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Midia extends Model
{

    use  SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'midias';

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
        'questao_id', 'arquivo',
    ];
}
