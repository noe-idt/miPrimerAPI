<?php
namespace App\Http\Controllers\Categoria;
use Illuminate\Support\Facades\DB;


class CategoriaRepoData {

    public function index(){
        $categorias = DB::select( 'SELECT categorias.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act from categorias LEFT JOIN usuarios autor ON categorias.registro_autor_id = autor.id_usuario LEFT JOIN usuarios autor_act ON categorias.actualizacion_autor_id=autor_act.id_usuario');
        
        return $categorias;
      }
      public function getCategoria($categoria){
          $categorias = DB::table('categorias')->where('categoria_id', $categoria)
          ->get();
          return $categorias;
      }
}
?>