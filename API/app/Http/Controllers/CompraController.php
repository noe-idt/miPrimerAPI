<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Compra\CompraServiceData;
use App\Http\Controllers\Compra\CompraServiceAction;
use Illuminate\Http\Request;

class CompraController extends Controller
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
        $listado = new CompraServiceData;
        $listar = $listado->listar();
        return  $listar;

    }

    public function obtenerDetalle($id){
        $compra = new CompraServiceData;
        $detalle = $compra->obtenerDetalle($id);
        return $detalle;
    }

    public function obtenerDetalleCompra($id){
        $compra = new CompraServiceData();
        $detalle = $compra->obtenerDetalleCompra($id);
        return $detalle;
    }

    public function agregar(Request $request){
        $compra = new CompraServiceAction;
        $compra->agregarCompra($request);
    }
    public function editar(Request $request){
        $compra = new CompraServiceAction;
        $compra->editarCompra($request);
        
    }
    public function eliminar(Request $request){
        $compra = new CompraServiceAction;
        $compra->eliminarCompra($request);

    }

    
}
