<?php
namespace App\Http\Controllers\Categoria;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoriaRepoAction{
    public function create(Request $request){
            $categorias = DB::table('categorias')->insert([
                'categoria_id' => $request->categoria_id, 'nombre' => $request->nombre, 'registro_autor_id' => $request->registro_autor_id]);
            if($categorias == 1){
                echo "Categoria registrada exitosamente" ;
            }else{
                echo "error al registrar Categoria";
            }
            return $categorias;
   
    }

    public function delete(Request $request){
        $categorias = DB::table('categorias')->where('categoria_id', $request->id)
        ->update(['status' => 300,]); 
               if($categorias == 1){
            echo "Categoria inactiva";
        }else{
            echo "No se pudo actualizar";
        }
    }

    public function edit(Request $request){
        $categorias = DB::table('categorias')->where('categoria_id', $request->id)
        ->update([
             'nombre' => $request->nombre, 'actualizacion_autor_id' => $request->actualizacion_autor_id]);
        if($categorias == 1){
            echo "Categoria editada exitosamente" ;
        }else{
            echo "Ocurrió un error al actualizar la Categoria";
        }
    }
}

?>