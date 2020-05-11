<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";

    //Datos del modelo cliente
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

    //Relación one to many (inverso)    
    public function concesionario()
    {
        return $this->belongsTo('App\Concesionario', 'concesionario_id');
    }

    
}
