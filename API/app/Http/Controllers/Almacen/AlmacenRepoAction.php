<?php
namespace App\Http\Controllers\Almacen;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AlmacenRepoAction{
    public function create(Request $request){
            $almacenes = DB::table('cat_almacenes')->insert([
                'almacen_id' => $request->almacen_id, 'nombre' => $request->nombre, 'ubicacion_primaria' => $request->ubicacion_primaria, 'ubicacion_secundaria' => $request->ubicacion_secundaria, 'folio' => $request->folio, 'responsable_nombre' => $request->responsable_nombre, 'registro_autor_id' => $request->registro_autor_id, 'registro_fecha' => $request->registro_fecha]);
            if($almacenes == 1){
                echo "almacen registrado exitosamente" ;
            }else{
                echo "error al registrar almacen";
            }
            return $almacenes;
   
    }

    public function delete(Request $request){
        $almacenes = DB::table('cat_almacenes')->where('almacen_id', $request->id)
        ->update(['status' => 300,]); 
               if($almacenes == 1){
            echo "almacen inactivo";
        }else{
            echo "No se pudo actualizar";
        }
    }

    public function edit(Request $request){
        $almacenes = DB::table('cat_almacenes')->where('almacen_id', $request->id)
        ->update([
             'nombre' => $request->nombre, 'ubicacion_primaria' => $request->ubicacion_primaria, 'ubicacion_secundaria' => $request->ubicacion_secundaria, 'folio' => $request->folio, 'responsable_nombre' => $request->responsable_nombre,'actualizacion_autor_id' => $request->actualizacion_autor_id, 'actualizacion_fecha' => $request->actualizacion_fecha]);
        if($almacenes == 1){
            echo "almacen editado exitosamente" ;
        }else{
            echo "Ocurrió un error al actualizar la almacen";
        }
    }
}

?>