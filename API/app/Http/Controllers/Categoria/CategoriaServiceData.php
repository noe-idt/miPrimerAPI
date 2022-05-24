<?php
namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Categoria\CategoriaRepoData;


class CategoriaServiceData{
    
    public function listar(){
        $lista = new CategoriaRepoData;
        $listado = $lista->index();
        return $listado;
    }

    public function obtenerDetalle($id){
        $categoria = new CategoriaRepoData;
        $detalle = $categoria->getCategoria($id);
        return $detalle;
    }
}
?>