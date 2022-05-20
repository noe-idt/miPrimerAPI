<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Objeto\ObjetoServiceData;
use App\Http\Controllers\Objeto\ObjetoServiceAction;
use Illuminate\Http\Request;

class ObjetoController extends Controller
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
        $listado = new ObjetoServiceData;
        $listar = $listado->listar();
        return  $listar;

    }

    public function obtenerDetalle($id){
        $usuario = new ObjetoServiceData;
        $detalle = $usuario->obtenerDetalle($id);
        return $detalle;
    }

    public function agregar(Request $request){
        $usuario = new ObjetoServiceAction;
        $usuario->agregarUsuario($request);
    }
    public function editar(Request $request){
        $usuario = new ObjetoServiceAction;
        $usuario->editarUsuario($request);
        
    }
    public function eliminar(Request $request){
        $usuario = new ObjetoServiceAction;
        $eliminado = $usuario->eliminarUsuario($request);

    }
    //
}
