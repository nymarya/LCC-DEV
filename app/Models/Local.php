<?php

namespace App\Models;

use App\Vinculo;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locais';

    public function vinculo()
    {
        $this->hasMany(Vinculo::class);
    }
}
