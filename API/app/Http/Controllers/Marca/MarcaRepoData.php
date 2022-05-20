<?php
namespace App\Http\Controllers\Marca;
use Illuminate\Support\Facades\DB;


class MarcaRepoData {

    public function index(){
        $marcas = DB::table('cat_marcas')->get();
        return $marcas;
      }
 
      public function getMarca($marca){
          $marcas = DB::table('cat_marcas')->where('marca_id', $marca)
          ->get();
          return $marcas;
      }
}
?>