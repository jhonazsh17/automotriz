<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concesionario extends Model
{
    protected $table = "concesionarios";

    //Datos del modelo concesionario
    protected $fillable = [ 
        'nombre',
        'direccion',
        'ciudad',
        'provincia',
        'departamento',
        'telefono',         
    ];

    //Relación one to many    
    public function clientes(){
        return $this->hasMany('App\Cliente', 'concesionario_id', 'id');
    }
}
