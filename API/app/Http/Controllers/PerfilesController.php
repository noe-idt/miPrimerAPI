<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Perfiles\PerfilServiceData;
use App\Http\Controllers\Perfiles\PerfilServiceAction;
use Illuminate\Http\Request;

class PerfilesController extends Controller
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
        $listado = new PerfilServiceData;
        $listar = $listado->listar();
        return  $listar;

    }

    public function obtenerDetalle($id){
        $perfil = new PerfilServiceData;
        $detalle = $perfil->obtenerDetalle($id);
        return $detalle;
    }

    public function agregar(Request $request){
        $perfil = new PerfilServiceAction;
        $perfil->agregarPerfil($request);
    }
    public function editar(Request $request){
        $perfil = new PerfilServiceAction;
        $perfil->editarPerfil($request);
        
    }
    public function eliminar(Request $request){
        $perfil = new PerfilServiceAction;
        $perfil->eliminarPerfil($request);

    }
    //
}
