<?php
namespace App\Http\Controllers\Almacen;
use Illuminate\Support\Facades\DB;


class AlmacenRepoData {

    public function index(){
        $almacenes = DB::select('SELECT cat_almacenes.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act from cat_almacenes LEFT JOIN usuarios autor ON cat_almacenes.registro_autor_id = autor.id_usuario LEFT JOIN usuarios autor_act ON cat_almacenes.actualizacion_autor_id=autor_act.id_usuario');


        return $almacenes;
      }
 
      public function getAlmacen($almacen){
          
          $almacenes = DB::select('SELECT cat_almacenes.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act from cat_almacenes LEFT JOIN usuarios autor ON cat_almacenes.registro_autor_id = autor.id_usuario LEFT JOIN usuarios autor_act ON cat_almacenes.actualizacion_autor_id=autor_act.id_usuario WHERE almacen_id = ?', [$almacen]);
          return $almacenes;
      }
}
?>