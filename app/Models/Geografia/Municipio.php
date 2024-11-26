<?php

namespace App\Models\Geografia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{
    use SoftDeletes;

    protected $fillable = ['departamento_id', 'nombre'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
