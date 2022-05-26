<?php
namespace App\Http\Controllers\Producto;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductoRepoAction{
    public function create(Request $request){
            $productos = DB::table('productos')->insert([
                'producto_id' => $request->producto_id,'nombre' => $request->nombre, 'descripcion' => $request->descripcion, 'precio' => $request->precio, 'fecha_registro' => $request->fecha_registro, 'registro_autor_id' => $request->registro_autor_id]);
            if($productos == 1){
                echo "producto insertado" ;
            }else{
                echo "producto no insertado";
            }
            return $productos;
   
    }

    public function delete(Request $request){
        $productos = DB::table('productos')->where('producto_id', $request->id)
        ->update(['status' => 300,]); 
               if($productos == 1){
            echo "producto eliminado";
        }else{
            echo "producto no eliminado";
        }
    }

    public function edit(Request $request){
        $productos = DB::table('productos')->where('producto_id', $request->id)
        ->update(['nombre' => $request->nombre, 'descripcion' => $request->descripcion, 'precio' => $request->precio]);
        if($productos == 1){
            echo "producto editado" ;
        }else{
            echo "producto no editado";
        }
    }
}

?>