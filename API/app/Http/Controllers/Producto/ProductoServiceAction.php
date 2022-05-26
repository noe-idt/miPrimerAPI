<?php
namespace App\Http\Controllers\Producto;
use Illuminate\Http\Request;

class ProductoServiceAction{
    
    public function agregarProducto(Request $request){
        $producto = new ProductoRepoAction;
        $producto->create($request);
    }
    public function eliminarProducto(Request $request){
        $producto = new ProductoRepoAction;
        $producto->delete($request);
    }

    public function editarProducto(Request $request){
        $producto = new ProductoRepoAction;
        $producto->edit($request);
    }
}


?>