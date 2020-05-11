<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Concesionario;

class ConcesionarioController extends Controller
{
    /**
     * Método para obetener todos los concesionarios 
     */
    public function getAll(){
        $concesionarios = Concesionario::all();
        return $concesionarios;
    }
}
