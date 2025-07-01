<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
     protected $fillable = [
        'nombre', 'cif', 'direccion', 'telefono', 'logo'
    ];

    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class);
    }
}
