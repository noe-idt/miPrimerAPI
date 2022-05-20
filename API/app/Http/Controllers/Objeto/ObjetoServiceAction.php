<?php
namespace App\Http\Controllers\Objeto;
use Illuminate\Http\Request;

class ObjetoServiceAction{
    
    public function agregarUsuario(Request $request){
        $usuario = new ObjetoRepoAction;
        $usuario->create($request);
    }
    public function eliminarUsuario(Request $request){
        $usuario = new ObjetoRepoAction;
        $usuario->delete($request);
    }

    public function editarUsuario(Request $request){
        $usuario = new ObjetoRepoAction;
        $usuario->edit($request);
    }
}


?>