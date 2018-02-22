<?php

namespace App;

use App\Models\Questao;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assunto',
    ];

    public function questoes(){
        return $this->hasMany(Questao::class);
    }
}
