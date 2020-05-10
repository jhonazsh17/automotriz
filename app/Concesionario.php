<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concesionario extends Model
{
    protected $table = "concesionarios";

    protected $fillable = [ 
        'nombre',
        'direccion',
        'ciudad',
        'provincia',
        'departamento',
        'telefono',         
    ];
}
