<?php
namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Almacen\AlmacenRepoData;


class AlmacenServiceData{
    
    public function listar(){
        $lista = new AlmacenRepoData;
        $listado = $lista->index();
        return $listado;
    }

    public function obtenerDetalle($id){
        $almacen = new AlmacenRepoData;
        $detalle = $almacen->getAlmacen($id);
        return $detalle;
    }
}
?>