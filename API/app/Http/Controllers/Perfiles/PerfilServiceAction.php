<?php
namespace App\Http\Controllers\Perfiles;
use Illuminate\Http\Request;

class PerfilServiceAction{
    public function agregarPerfil(Request $request){
        $perfil = new PerfilRepoAction;
        $perfil->create($request);
    }
    public function eliminarPerfil(Request $request){
        $perfil = new PerfilRepoAction;
        $perfil->delete($request);
    }
    public function editarPerfil(Request $request){
        $perfil = new PerfilRepoAction;
        $perfil->edit($request);
    }
}
?>