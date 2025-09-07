<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trabajador extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'trabajadores';

    protected $fillable = [
        'empresa_id', 'nombre', 'email', 'nif', 'pin', 'horas', 'user_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function fichajes()
    {
        return $this->hasMany(Fichaje::class);
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
