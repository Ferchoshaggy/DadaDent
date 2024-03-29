<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vista_mate(){
        $materiales=DB::table('materiales')->select('*')->get();
        return view('Materiales.materiales',compact('materiales'));
    }

    public function save_mate(Request $request){
try {

DB::table('materiales')->insert([
    "Nombre"=>$request['nombre'],
    "Costo"=>$request['costo'],
    "Unidades"=>$request['unidades'],
    "Uso_de_unidad"=>$request['uso_unidad'],
    "Costo_por_uso"=>$request['costo_uso']
]);
return redirect()->back()->with(['message' => 'El Material se Agrego Corectamente', 'color' => 'info']);

} catch (\Throwable $th) {
    //throw $th;
}
    }

    public function mate_delete(Request $request){
        try{
            DB::table('materiales')->where("id",$request['id_mate'])->delete();
            return redirect()->back()->with(['message' => 'El Material se Elimino Corectamente', 'color' => 'info']);
        }catch (\Throwable $th){

        }
    }

    public function mate_update(Request $request){
        try{
DB::table('materiales')->where("id",$request['id_mate2'])->update([
    "Nombre"=>$request['nombre'],
    "Costo"=>$request['costo'],
    "Unidades"=>$request['unidades'],
    "Uso_de_unidad"=>$request['uso_unidad'],
    "Costo_por_uso"=>$request['costo_uso']
]);
return redirect()->back()->with(['message' => 'El Material se actualizo Corectamente', 'color' => 'info']);
        }catch (\Throwable $th){

        }
    }
}
