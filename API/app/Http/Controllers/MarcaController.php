<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Marca\MarcaServiceData;
use App\Http\Controllers\Marca\MarcaServiceAction;
use Illuminate\Http\Request;

class MarcaController extends Controller
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
        $listado = new MarcaServiceData;
        $listar = $listado->listar();
        return  $listar;

    }

    public function obtenerDetalle($id){
        $marca = new MarcaServiceData;
        $detalle = $marca->obtenerDetalle($id);
        return $detalle;
    }

    public function agregar(Request $request){
        $marca = new MarcaServiceAction;
        $marca->agregarMarca($request);
    }
    public function editar(Request $request){
        $marca = new MarcaServiceAction;
        $marca->editarMarca($request);
        
    }
    public function eliminar(Request $request){
        $marca = new MarcaServiceAction;
        $marca->eliminarMarca($request);
    }
    //
}
