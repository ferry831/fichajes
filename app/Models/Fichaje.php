<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fichaje extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'trabajador_id',
        'empresa_id',
        'fecha',
        'hora_entrada',
        'hora_salida',
        
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function pausas()
    {
        return $this->hasMany(Pausa::class);
    }
}
