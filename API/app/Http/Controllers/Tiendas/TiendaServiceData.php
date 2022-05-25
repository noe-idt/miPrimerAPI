<?php
namespace App\Http\Controllers\Tiendas;

use App\Http\Controllers\Tiendas\TiendaRepoData;


class TiendaServiceData{
    
    public function listar(){
        $lista = new TiendaRepoData;
        $listado = $lista->index();
        return $listado;
    }

    public function obtenerDetalle($id){
        $tienda = new TiendaRepoData;
        $detalle = $tienda->getTienda($id);
        return $detalle;
    }
}
?>