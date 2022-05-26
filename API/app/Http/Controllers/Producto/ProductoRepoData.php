<?php
namespace App\Http\Controllers\Producto;

use Illuminate\Support\Facades\DB;


class ProductoRepoData {

    public function index(){
        $productos = DB::table('productos')->get();
        return $productos;
      }
 
      public function getProducto($producto){
          $productos = DB::table('productos')->where('producto_id', $producto)
          ->get();
          return $productos;
      }

      public function busqueda($producto){
            $productos = DB::table('productos')
          ->where('nombre','LIKE', '%' . $producto . '%')
          ->get();
          return $productos;
      }
}
?>