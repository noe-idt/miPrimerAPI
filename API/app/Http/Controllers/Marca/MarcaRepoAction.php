<?php
namespace App\Http\Controllers\Marca;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MarcaRepoAction{
    public function create(Request $request){
            $marcas = DB::table('cat_marcas')->insert([
                'marca_id' => $request->marca_id, 'nombre' => $request->nombre, 'registro_autor_id' => $request->registro_autor_id]);
            if($marcas == 1){
                echo "Marca registrada exitosamente" ;
            }else{
                echo "error al registrar marca";
            }
            return $marcas;
   
    }

    public function delete(Request $request){
        $marcas = DB::table('cat_marcas')->where('marca_id', $request->marca_id)
        ->update(['status' => 300,]); 
               if($marcas == 1){
            echo "marca inactiva";
        }else{
            echo "No se pudo actualizar";
        }
    }

    public function edit(Request $request){
        $marcas = DB::table('cat_marcas')->where('marca_id', $request->marca_id)
        ->update([
             'nombre' => $request->nombre,'actualizacion_fecha', 'actualizacion_autor_id' => $request->actualizacion_autor_id, ]);
        if($marcas == 1){
            echo "marca editada exitosamente" ;
        }else{
            echo "Ocurrió un error al actualizar la marca";
        }
    }
}

?>