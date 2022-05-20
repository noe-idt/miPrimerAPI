<?php
namespace App\Http\Controllers\Objeto;

use App\Http\Controllers\Objeto\ObjetoRepoData as ObjetoRepoData;


class ObjetoServiceData{
    
    public function listar(){
        $lista = new ObjetoRepoData;
        $listado = $lista->index();
        return $listado;
    }

    public function obtenerDetalle($id){
        $usuario = new ObjetoRepoData;
        $detalle = $usuario->getUsuario($id);
        return $detalle;
    }
}


?>