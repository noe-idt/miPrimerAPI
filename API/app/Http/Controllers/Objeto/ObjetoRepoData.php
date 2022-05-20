<?php
namespace App\Http\Controllers\Objeto;

use Illuminate\Support\Facades\DB;


class ObjetoRepoData {

    public function index(){
        $usuarios = DB::table('usuarios')->get();
        return $usuarios;
      }
 
      public function getUsuario($usuario){
          $usuarios = DB::table('usuarios')->where('id_usuario', $usuario)
          ->get();
          return $usuarios;
      }
}
?>