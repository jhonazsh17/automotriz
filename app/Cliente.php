<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $fillable = [ 
        'nombres',
        'apellidos',
        'dni',
        'codigo_autogenerado',
        'direccion',
        'ciudad',
        'provincia',
        'departamento',
        'nro_telefono',
        'fecha_nacimiento',
        'estado',
        'concesionario_id', 
    ];
}
