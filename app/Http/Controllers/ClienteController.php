<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;
use App\Concesionario;

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
        return $this->getClientes($clientes);
    }   

    public function getClienteByConcesionario($idConcesionario){
        $clientes = Concesionario::find($idConcesionario)->clientes;
        return $this->getClientes($clientes);
    }

    private function getClientes($clientes){
        $clientesArray = [];
        $i=0;
        foreach ($clientes as $cliente) {
            $clientesArray[$i] = $cliente;
            $clientesArray[$i]['concesionario_name'] = $cliente->concesionario->nombre;
            $i=$i+1;
        }
        return $clientesArray;
    }

    public function getClienteByName($word){
        $clientes = Cliente::all();
        $clientesArray = [];
        $clientesFilter = [];
        $i=0;
        $j=0;
        foreach ($clientes as $cliente) {
            $clientesArray[$i]=$cliente;
            $clientesArray[$i]['fullName'] = $cliente->nombres." ".$cliente->apellidos;
            $i=$i+1;
        }

        foreach ($clientesArray as $cliente) {
            if($this->compareCad($cliente['fullName'], $word)){
                $clientesFilter[$j] = $cliente;
                $clientesFilter[$j]['concesionario_name'] = $cliente->concesionario->nombre;
                $j=$j+1;
            }
            
        }
        return $clientesFilter;
    }

    public function getClienteByDoc($doc){
        $clientes = Cliente::all();
        $clientesFilter = [];
        $j=0;

        foreach ($clientes as $cliente) {
            if($this->compareCad($cliente['dni'], $doc)){
                $clientesFilter[$j] = $cliente;
                $clientesFilter[$j]['concesionario_name'] = $cliente->concesionario->nombre;
                $j=$j+1;
            }
            
        }
        return $clientesFilter;
    }

    private function compareCad($cad, $subcad){
        $cad = strtolower($cad);
        $subcad = strtolower($subcad);
        if (strpos($cad, $subcad) !== false) {
            return true;
        }else{
            return false;
        }
    }        

    public function remove(Request $request){
        $cliente = Cliente::find($request->id);
        $cliente->estado = "0";
        $cliente->save();
        return $cliente;
    }
    
    public function resetCliente($idCliente){
        $cliente = Cliente::find($idCliente);
        $cliente->estado = "1";
        $cliente->save();
        return $cliente;
    }
}
