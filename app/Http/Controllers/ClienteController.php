<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;

class ClienteController extends Controller
{
    public function save(Request $request){
        try {

            $cliente = Cliente::create([ 
                'nombres'=> $request->nombres,
                'apellidos'=> $request->apellidos,
                'dni'=> $request->dni,
                'codigo_autogenerado'=> "jajaja",
                'direccion'=> $request->direccion,
                'ciudad'=> $request->distrito,
                'provincia'=> $request->provincia,
                'departamento'=> $request->departamento,
                'nro_telefono'=> $request->telefono,
                'fecha_nacimiento'=> $request->fechaNacimiento,
                'concesionario_id'=> $request->concesionario,
                'estado'=>'1'        
            ]);

            return $cliente; 

        } catch(\Exception $e){
        
        }   
    }

    public function getAll(){
        $clientes = Cliente::all();
        return $clientes;
    }   

    public function remove(Request $request){
        $cliente = Cliente::where('dni', $request->dni)->first();
        $cliente->state = 0;
        $cliente->save();
    }   
}
