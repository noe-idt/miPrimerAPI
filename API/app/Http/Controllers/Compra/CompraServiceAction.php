<?php
namespace App\Http\Controllers\Compra;
use Illuminate\Http\Request;

class CompraServiceAction{
    public function agregarCompra(Request $request){
        $compra = new CompraRepoAction;
        $compra->create($request);
    }
    public function eliminarCompra(Request $request){
        $compra = new CompraRepoAction;
        $compra->delete($request);
    }
    public function editarCompra(Request $request){
        $compra = new CompraRepoAction;
        $compra->edit($request);
    }
}
?>