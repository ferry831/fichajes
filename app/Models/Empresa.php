<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Empresa extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'razon_social', 'cif', 'direccion', 'ccc', 'pin', 'activa', 'user_id'
    ];

    public function administrador() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trabajadores() {
        return $this->hasMany(Trabajador::class, 'empresa_id');
    }
}
