<?php

namespace App\Models;

use App\Models\Local;
use App\Models\Roles\Paciente;
use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    protected $table = 'vinculos';

    protected $fillable = [
        'admissao', 'alta', 'quant_mot', 'quant_resp',
        'plano_saude_id', 'local_id', 'paciente_id'
    ];

    public function local()
    {
        $this->belongsTo(Local::class);
    }

    public function paciente()
    {
        $this->belongsTo(Paciente::class);
    }
}
