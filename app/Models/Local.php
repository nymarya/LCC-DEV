<?php

namespace App\Models;

use App\Models\Vinculo;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locais';

    protected $fillable = [
        'nome'
    ];

    public function vinculos()
    {
        $this->hasMany(Vinculo::class, 'local_id');
    }
}
