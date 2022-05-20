<?php
namespace App\Http\Controllers\Objeto;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ObjetoRepoAction{
    public function create(Request $request){
            $usuarios = DB::table('usuarios')->insert([
                'nombre_usuario' => $request->nombre_usuario, 'password' => $request->password, 'usuario' => $request->usuario, 'correo' => $request->correo]);
            if($usuarios == 1){
                echo "usuario insertado" ;
            }else{
                echo "usuario no insertado";
            }
            return $usuarios;
   
    }

    public function delete(Request $request){
        $usuarios = DB::table('usuarios')->where('id_usuario', $request->id)
        ->update(['status' => 300,]); 
               if($usuarios == 1){
            echo "usuario eliminado";
        }else{
            echo "usuario no eliminado";
        }
    }

    public function edit(Request $request){
        $usuarios = DB::table('usuarios')->where('id_usuario', $request->id)
        ->update(['nombre_usuario' => $request->nombre_usuario, 'password' => $request->password, 'usuario' => $request->usuario, 'correo' => $request->correo]);
        if($usuarios == 1){
            echo "usuario editado" ;
        }else{
            echo "usuario no editado";
        }
    }
}

?>