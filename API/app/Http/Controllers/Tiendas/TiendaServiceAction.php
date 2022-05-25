<?php
namespace App\Http\Controllers\Tiendas;
use Illuminate\Http\Request;

class TiendaServiceAction{
    public function agregarTienda(Request $request){
        $tienda = new TiendaRepoAction;
        $tienda->create($request);
    }
    public function eliminarTienda(Request $request){
        $tienda = new TiendaRepoAction;
        $tienda->delete($request);
    }
    public function editarTienda(Request $request){
        $tienda = new TiendaRepoAction;
        $tienda->edit($request);
    }
}
?>