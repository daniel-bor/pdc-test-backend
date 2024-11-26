<?php

namespace App\Models;

use App\Models\Geografia\Pais;
use App\Models\Geografia\Municipio;
use App\Models\Geografia\Departamento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pais_id',
        'departamento_id',
        'municipio_id',
        'nit',
        'razon_social',
        'nombre_comercial',
        'telefono',
        'correo',
        'direccion',
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function colaboradores()
    {
        return $this->belongsToMany(Colaborador::class, 'colaborador_empresa');
    }
}
