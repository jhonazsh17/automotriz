<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;

class ClienteController extends Controller
{
    public function save(Request $request){
        try {

            //Insertar cliente en la base de datos
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
            
            //retorn cliente registrado
            return $cliente; 

        } catch(\Exception $e){
        
        }   
    }

    public function saveUpdate(Request $request){
        $cliente = Cliente::find($request->id);
        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->dni = $request->dni;
        $cliente->nro_telefono = $request->nro_telefono;
        $cliente->direccion = $request->direccion;
        $cliente->ciudad = $request->ciudad;
        $cliente->provincia = $request->provincia;
        $cliente->departamento = $request->departamento;
        $cliente->fecha_nacimiento = $request->fecha_nacimiento;
        $cliente->concesionario_id = $request->concesionario_id;
        $cliente->save();

        return $cliente;
    }  

    public function getAll(){
        $clientes = Cliente::all();
        return $clientes;
    }   

    public function remove(Request $request){
        $cliente = Cliente::where('dni', $request->dni)->first();
        
        return $cliente;
    }   
}
