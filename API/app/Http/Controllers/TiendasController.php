<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Tiendas\TiendaServiceData;
use App\Http\Controllers\Tiendas\TiendaServiceAction;
use Illuminate\Http\Request;

class TiendasController extends Controller
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
        $listado = new TiendaServiceData;
        $listar = $listado->listar();
        return  $listar;

    }

    public function obtenerDetalle($id){
        $tienda = new TiendaServiceData;
        $detalle = $tienda->obtenerDetalle($id);
        return $detalle;
    }

    public function agregar(Request $request){
        $tienda = new TiendaServiceAction;
        $tienda->agregarTienda($request);
    }
    public function editar(Request $request){
        $tienda = new TiendaServiceAction;
        $tienda->editarTienda($request);
        
    }
    public function eliminar(Request $request){
        $tienda = new TiendaServiceAction;
        $tienda->eliminarTienda($request);

    }
    //
}
