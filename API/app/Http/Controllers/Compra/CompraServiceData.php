<?php
namespace App\Http\Controllers\Compra;

use App\Http\Controllers\Compra\CompraRepoData;


class CompraServiceData{
    
    public function listar(){
        $lista = new CompraRepoData;
        $listado = $lista->index();
        return $listado;
    }

    public function obtenerDetalle($id){
        $compra = new CompraRepoData;
        $detalle = $compra->getCompra($id);
        return $detalle;
    }

    public function obtenerDetalleCompra($id){
        $compra = new CompraRepoData;
        $detalle = $compra->getDetalleCompra($id);
        return $detalle;
    }
}
?>