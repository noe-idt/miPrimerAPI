<?php
namespace App\Http\Controllers\Perfiles;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PerfilRepoAction{
    public function create(Request $request){
            $perfiles = DB::table('sys_perfiles')->insert([
                'perfil_id' => $request->perfil_id, 'nombre' => $request->nombre, 'clave' => $request->clave, 'descripcion' => $request->descripcion, 'registro_autor_id' => $request->registro_autor_id]);
            if($perfiles == 1){
                echo "perfil registrado exitosamente" ;
            }else{
                echo "error al registrar perfil";
            }
            return $perfiles;
   
    }

    public function delete(Request $request){
        $perfiles = DB::table('sys_perfiles')->where('perfil_id', $request->id)
        ->update(['status' => 300,]); 
               if($perfiles == 1){
            echo "perfil inactivo";
        }else{
            echo "No se pudo actualizar";
        }
    }

    public function edit(Request $request){
        $perfiles = DB::table('sys_perfiles')->where('perfil_id', $request->id)
        ->update([
             'nombre' => $request->nombre, 'clave' => $request->clave, 'descripcion' => $request->descripcion]);
        if($perfiles == 1){
            echo "perfil editado exitosamente" ;
        }else{
            echo "Ocurrió un error al actualizar la perfil";
        }
    }
}

?>