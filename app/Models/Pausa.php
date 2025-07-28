<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pausa extends Model
{
    protected $fillable = [
        'fichaje_id',
        'inicio',
        'fin',
    ];

    public function fichaje()
    {
        return $this->belongsTo(Fichaje::class);
    }
}
