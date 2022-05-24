<?php
namespace App\Http\Controllers\Perfiles;
use Illuminate\Support\Facades\DB;


class PerfilRepoData {

    public function index(){
        $perfiles = DB::select('SELECT sys_perfiles.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act from sys_perfiles LEFT JOIN usuarios autor ON sys_perfiles.registro_autor_id = autor.id_usuario LEFT JOIN usuarios autor_act ON sys_perfiles.actualizacion_autor_id=autor_act.id_usuario');


        return $perfiles;
      }
 
      public function getPerfil($perfil){
          
          $perfiles = DB::select('SELECT sys_perfiles.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act from sys_perfiles LEFT JOIN usuarios autor ON sys_perfiles.registro_autor_id = autor.id_usuario LEFT JOIN usuarios autor_act ON sys_perfiles.actualizacion_autor_id=autor_act.id_usuario WHERE perfil_id = ?', [$perfil]);
          
          return $perfiles;
      }
}
?>