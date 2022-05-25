<?php
namespace App\Http\Controllers\Almacen;
use Illuminate\Http\Request;

class AlmacenServiceAction{
    public function agregarAlmacen(Request $request){
        $almacen = new AlmacenRepoAction;
        $almacen->create($request);
    }
    public function eliminarAlmacen(Request $request){
        $almacen = new AlmacenRepoAction;
        $almacen->delete($request);
    }
    public function editarAlmacen(Request $request){
        $almacen = new AlmacenRepoAction;
        $almacen->edit($request);
    }
}
?>