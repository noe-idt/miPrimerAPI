<?php

namespace App\Http\Controllers\Compra;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CompraRepoAction
{
    public function create(Request $request)
    {
        $productos = $request->productos;
        $insert = [ 'serie' => 'PR'];
        foreach ( $productos as $producto){
            $totalProductos = $producto['cantidad'] + $producto['cantidad'];
            $subtotal = $producto['cantidad'] * $producto['precio'];
            $subtotalIva = $subtotal + $subtotal * 0.16;
            $total = $total + $subtotalIva;
        }


        $compras = DB::table('compras')->insert(array_merge($insert,[
            'folio'                                      => DB::raw( "(SELECT 
                                                                            COALESCE ( MAX ( folio ) , 0 ) + 1
                                                                            FROM
                                                                                    compras 
                                                                                        )"),
            'serie_folio'                               => DB::raw( "(
                                                                    dSELECT 
                                                                        CONCAT (
                                                                             '{$insert['serie']}', '-', 
                                                                            ( SELECT LPAD ( ( COALESCE ( MAX ( folio ), 0 ) +1 )::TEXT, 5 , '0') FROM compras ) 
                                                                        )
                                                                    )"),

            'compra_id' => $request->compra_id,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'factura_folio' => $request->factura_folio,
            'descripcion' => $request->descripcion,

                                                                        ]));

        $compras = DB::table('compras_detalle')->insert([
            'descripcion' => $request->descripcion,
            'productos' => $productos,
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
