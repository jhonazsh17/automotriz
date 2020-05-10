<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Concesionario;

class ConcesionarioController extends Controller
{
    public function getAll(){
        $concesionarios = Concesionario::all();
        return $concesionarios;
    }
}
