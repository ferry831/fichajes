<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $fillable = [
        'empresa_id', 'nombre', 'apellidos', 'email', 'nif', 'pin'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function fichajes()
    {
        return $this->hasMany(Fichaje::class);
    }
}
