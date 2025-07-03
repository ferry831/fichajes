<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use HasFactory;
     protected $fillable = [
        'nombre', 'cif', 'direccion', 'telefono', 'logo'
    ];

    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class);
    }
}
