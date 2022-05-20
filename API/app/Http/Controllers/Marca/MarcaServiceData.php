<?php
namespace App\Http\Controllers\Marca;

use App\Http\Controllers\Marca\MarcaRepoData;


class MarcaServiceData{
    
    public function listar(){
        $lista = new MarcaRepoData;
        $listado = $lista->index();
        return $listado;
    }

    public function obtenerDetalle($id){
        $marca = new MarcaRepoData;
        $detalle = $marca->getMarca($id);
        return $detalle;
    }
}
?>