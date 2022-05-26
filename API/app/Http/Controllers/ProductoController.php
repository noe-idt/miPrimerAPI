<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Producto\ProductoServiceData;
use App\Http\Controllers\Producto\ProductoServiceAction;
use Illuminate\Http\Request;

class ProductoController extends Controller
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
        $listado = new ProductoServiceData;
        $listar = $listado->listar();
        return  $listar;

    }

    public function obtenerDetalle($id){
        $producto = new ProductoServiceData;
        $detalle = $producto->obtenerDetalle($id);
        return $detalle;
    }

    public function agregar(Request $request){
        $producto = new ProductoServiceAction;
        $producto->agregarProducto($request);
    }
    public function editar(Request $request){
        $producto = new ProductoServiceAction;
        $producto->editarProducto($request);
        
    }
    public function eliminar(Request $request){
        $producto = new ProductoServiceAction;
         $producto->eliminarProducto($request);

    }

    public function busqueda($producto){
        $filtro = new ProductoServiceData;;
        $resultado = $filtro->busqueda($producto);
        return $resultado;
    }
    //
}
