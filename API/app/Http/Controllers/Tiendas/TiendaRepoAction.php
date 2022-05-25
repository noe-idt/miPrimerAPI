<?php
namespace App\Http\Controllers\Tiendas;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TiendaRepoAction{
    public function create(Request $request){
            $tiendas = DB::table('cat_tiendas')->insert([
                'tienda_id' => $request->tienda_id, 'nombre' => $request->nombre, 'nombre_comercial' => $request->nombre_comercial, 'direccion' => $request->direccion, 'clave' => $request->clave, 'gerente_nombre' => $request->gerente_nombre, 'registro_autor_id' => $request->registro_autor_id, 'registro_fecha' => $request->registro_fecha]);
            if($tiendas == 1){
                echo "tienda registrado exitosamente" ;
            }else{
                echo "error al registrar tienda";
            }
            return $tiendas;
   
    }

    public function delete(Request $request){
        $tiendas = DB::table('cat_tiendas')->where('tienda_id', $request->id)
        ->update(['status' => 300,]); 
               if($tiendas == 1){
            echo "tienda inactivo";
        }else{
            echo "No se pudo actualizar";
        }
    }

    public function edit(Request $request){
        $tiendas = DB::table('cat_tiendas')->where('tienda_id', $request->id)
        ->update([
             'nombre' => $request->nombre, 'nombre_comercial' => $request->nombre_comercial, 'direccion' => $request->direccion, 'clave' => $request->clave, 'gerente_nombre' => $request->gerente_nombre, 'actualizacion_autor_id' => $request->actualizacion_autor_id, 'actualizacion_fecha' => $request->actualizacion_fecha]);
        if($tiendas == 1){
            echo "tienda editado exitosamente" ;
        }else{
            echo "Ocurrió un error al actualizar la tienda";
        }
    }
}

?>