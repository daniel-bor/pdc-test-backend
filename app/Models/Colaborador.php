<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colaborador extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'correo',
    ];

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class, 'colaborador_empresa');
    }
}
