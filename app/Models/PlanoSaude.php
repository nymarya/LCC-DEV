<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanoSaude extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'planos_saude';

    protected $fillable = [
        'nome', 'motora_UTI', 'motora_APT', 'resp_UTI', 'resp_APT',
    ];
}
