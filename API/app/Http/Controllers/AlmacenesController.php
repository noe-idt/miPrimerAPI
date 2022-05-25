<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Almacen\AlmacenServiceData;
use App\Http\Controllers\Almacen\AlmacenServiceAction;
use Illuminate\Http\Request;

class AlmacenesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function listar(){
        $listado = new AlmacenServiceData;
        $listar = $listado->listar();
        return  $listar;

    }

    public function obtenerDetalle($id){
        $almacen = new AlmacenServiceData;
        $detalle = $almacen->obtenerDetalle($id);
        return $detalle;
    }

    public function agregar(Request $request){
        $almacen = new AlmacenServiceAction;
        $almacen->agregarAlmacen($request);
    }
    public function editar(Request $request){
        $almacen = new AlmacenServiceAction;
        $almacen->editarAlmacen($request);
        
    }
    public function eliminar(Request $request){
        $almacen = new AlmacenServiceAction;
        $almacen->eliminarAlmacen($request);

    }
    
}
