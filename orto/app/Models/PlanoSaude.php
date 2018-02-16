<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanoSaude extends Model
{
    protected $fillable = [
        'nome', 'motora_UTI', 'motora_APT', 'resp_UTI', 'resp_APT',
    ];
}
