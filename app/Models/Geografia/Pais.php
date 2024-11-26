<?php

namespace App\Models\Geografia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pais extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre'];

    public function departamentos()
    {
        return $this->hasMany(Departamento::class);
    }
}
