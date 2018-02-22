<?php

namespace App\Models\Roles;

use App\Models\Traits\Papel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model
{
    use Papel, SoftDeletes;

    /**
     * Role's verbose name.
     *
     * @var string
     */
    public $verbose = 'Professor';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professores';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];


    public function turmas(){

    }
}
