<?php
namespace App\Http\Controllers\Marca;
use Illuminate\Http\Request;

class MarcaServiceAction{
    public function agregarMarca(Request $request){
        $marca = new MarcaRepoAction;
        $marca->create($request);
    }
    public function eliminarMarca(Request $request){
        $marca = new MarcaRepoAction;
        $marca->delete($request);
    }
    public function editarMarca(Request $request){
        $marca = new MarcaRepoAction;
        $marca->edit($request);
    }
}
?>