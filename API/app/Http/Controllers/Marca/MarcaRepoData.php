<?php
namespace App\Http\Controllers\Marca;
use Illuminate\Support\Facades\DB;


class MarcaRepoData {

    public function index(){
        $marcas = DB::select( 'SELECT cat_marcas.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act from cat_marcas LEFT JOIN usuarios autor ON cat_marcas.registro_autor_id = autor.id_usuario LEFT JOIN usuarios autor_act ON cat_marcas.actualizacion_autor_id=autor_act.id_usuario');
        
        return $marcas;
      }
 
      public function getMarca($marca){
          $marcas = DB::table('cat_marcas')->where('marca_id', $marca)
          ->get();
          return $marcas;
      }
}
?>