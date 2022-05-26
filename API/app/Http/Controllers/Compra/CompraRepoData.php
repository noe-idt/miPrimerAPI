<?php
namespace App\Http\Controllers\Compra;
use Illuminate\Support\Facades\DB;


class CompraRepoData {

    public function index(){
        $compras = DB::select('SELECT compras.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act 
        from compras LEFT JOIN usuarios autor ON compras.registro_autor_id = autor.id_usuario 
        LEFT JOIN usuarios autor_act ON compras.actualizacion_autor_id=autor_act.id_usuario');


        return $compras;
      }
 
      public function getCompra($compra){
          
          $compras = DB::select('SELECT compras.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act 
          from compras 
          LEFT JOIN usuarios autor ON compras.registro_autor_id = autor.id_usuario 
          LEFT JOIN usuarios autor_act ON compras.actualizacion_autor_id=autor_act.id_usuario 
          WHERE compra_id = ?', [$compra]);
          return $compras;
      }


      public function getDetalleCompra($compra){
          $compras = DB::select('    SELECT compras_detalle.*, autor.nombre_usuario as autor , autor_act.nombre_usuario as autor_act 
          from compras_detalle 
          LEFT JOIN usuarios autor ON compras_detalle.registro_autor_id = autor.id_usuario 
          LEFT JOIN usuarios autor_act ON compras_detalle.actualizacion_autor_id=autor_act.id_usuario 
          WHERE compra_id = ?', [$compra]);
          return $compras;
      }
}
?>