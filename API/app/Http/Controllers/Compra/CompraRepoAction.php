<?php

namespace App\Http\Controllers\Compra;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CompraRepoAction
{
    public function create(Request $request)
    {
        $compras = DB::table('compras')->insert([
            'compra_id' => $request->compra_id,
            'nombre' => $request->nombre,
            'ubicacion_primaria' => $request->ubicacion_primaria,
            'ubicacion_secundaria' => $request->ubicacion_secundaria,
            'folio' => $request->folio,
            'responsable_nombre' => $request->responsable_nombre,
            'registro_autor_id' => $request->registro_autor_id,
            'registro_fecha' => $request->registro_fecha
        ]);
        if ($compras == 1) {
            echo "compra registrado exitosamente";
        } else {
            echo "error al registrar compra";
        }
        return $compras;
    }

    public function delete(Request $request)
    {
        $compras = DB::table('compras')->where('compra_id', $request->id)
            ->update(['status' => 300,]);
        if ($compras == 1) {
            echo "compra inactivo";
        } else {
            echo "No se pudo actualizar";
        }
    }

    public function edit(Request $request)
    {
        $compras = DB::table('cat_compras')->where('compra_id', $request->id)
            ->update([
                'nombre' => $request->nombre,
                'ubicacion_primaria' => $request->ubicacion_primaria,
                'ubicacion_secundaria' => $request->ubicacion_secundaria,
                'folio' => $request->folio,
                'responsable_nombre' => $request->responsable_nombre,
                'actualizacion_autor_id' => $request->actualizacion_autor_id,
                'actualizacion_fecha' => $request->actualizacion_fecha
            ]);
        if ($compras == 1) {
            echo "compra editado exitosamente";
        } else {
            echo "Ocurrió un error al actualizar la compra";
        }
    }
}
