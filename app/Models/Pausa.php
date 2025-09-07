<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pausa extends Model
{
    use HasFactory;
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
