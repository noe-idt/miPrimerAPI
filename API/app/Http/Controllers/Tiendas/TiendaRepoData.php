<?php
namespace App\Http\Controllers\Tiendas;
use Illuminate\Support\Facades\DB;


class TiendaRepoData {

    public function index(){
        $tiendas = DB::select('SELECT cat_tiendas.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act from cat_tiendas LEFT JOIN usuarios autor ON cat_tiendas.registro_autor_id = autor.id_usuario LEFT JOIN usuarios autor_act ON cat_tiendas.actualizacion_autor_id=autor_act.id_usuario');


        return $tiendas;
      }
 
      public function getTienda($tienda){
          
          $tiendas = DB::select('SELECT cat_tiendas.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act from cat_tiendas LEFT JOIN usuarios autor ON cat_tiendas.registro_autor_id = autor.id_usuario LEFT JOIN usuarios autor_act ON cat_tiendas.actualizacion_autor_id=autor_act.id_usuario WHERE tienda_id = ?', [$tienda]);
          return $tiendas;
      }
}
?>