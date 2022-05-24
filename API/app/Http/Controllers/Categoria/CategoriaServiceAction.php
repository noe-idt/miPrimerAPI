<?php
namespace App\Http\Controllers\Categoria;
use Illuminate\Http\Request;

class CategoriaServiceAction{
    public function agregarCategoria(Request $request){
        $categoria = new CategoriaRepoAction;
        $categoria->create($request);
    }
    public function eliminarCategoria(Request $request){
        $categoria = new CategoriaRepoAction;
        $categoria->delete($request);
    }
    public function editarCategoria(Request $request){
        $categoria = new CategoriaRepoAction;
        $categoria->edit($request);
    }
}
?>