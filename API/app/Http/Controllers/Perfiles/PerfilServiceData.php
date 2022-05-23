<?php
namespace App\Http\Controllers\Perfiles;

use App\Http\Controllers\Perfiles\PerfilRepoData;


class PerfilServiceData{
    
    public function listar(){
        $lista = new PerfilRepoData;
        $listado = $lista->index();
        return $listado;
    }

    public function obtenerDetalle($id){
        $perfil = new PerfilRepoData;
        $detalle = $perfil->getPerfil($id);
        return $detalle;
    }
}
?>