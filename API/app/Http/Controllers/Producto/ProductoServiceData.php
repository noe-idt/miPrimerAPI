<?php
namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Producto\ProductoRepoData as ProductoRepoData;


class ProductoServiceData{
    
    public function listar(){
        $lista = new ProductoRepoData;
        $listado = $lista->index();
        return $listado;
    }

    public function obtenerDetalle($id){
        $producto = new ProductoRepoData;
        $detalle = $producto->getProducto($id);
        return $detalle;
    }

    public function busqueda($producto){
        $busqueda  = new ProductoRepoData;
        $resultado = $busqueda->busqueda($producto);
        return $resultado;
    }
}


?>