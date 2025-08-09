<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $fillable = [
        'fichaje_id',
        'trabajador_id',
        'empresa_id',
        'tipo',
        'subtipo',
        'fecha_inicio',
        'fecha_fin',
        'observacion',
        'estado',
    ];

    public function fichaje()
    {
        return $this->belongsTo(Fichaje::class);
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }
}
