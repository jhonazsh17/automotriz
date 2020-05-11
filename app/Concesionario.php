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

    public function clientes(){
        return $this->hasMany('App\Cliente', 'concesionario_id', 'id');
    }
}
