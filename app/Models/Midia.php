<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Get the user's avatar url.
     *
     * @param  $value string
     * @return string
     */
    public function getArquivoAttribute($value)
    {
        if (! $value) {
            return url('img/file.png');
        }

        return Storage::url($value);
    }
}
