<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Categoria\CategoriaServiceData;
use App\Http\Controllers\Categoria\CategoriaServiceAction;
use Illuminate\Http\Request;

class CategoriaController extends Controller
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
        $listado = new CategoriaServiceData;
        $listar = $listado->listar();
        return  $listar;

    }

    public function obtenerDetalle($id){
        $categoria = new CategoriaServiceData;
        $detalle = $categoria->obtenerDetalle($id);
        return $detalle;
    }

    public function agregar(Request $request){
        $categoria = new CategoriaServiceAction;
        $categoria->agregarCategoria($request);
    }
    public function editar(Request $request){
        $categoria = new CategoriaServiceAction;
        $categoria->editarCategoria($request);
        
    }
    public function eliminar(Request $request){
        $categoria = new CategoriaServiceAction;
        $categoria->eliminarCategoria($request);
    }
    //
}
