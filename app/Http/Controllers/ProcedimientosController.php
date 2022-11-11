<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ProcedimientosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vista_proce(){

        $materiales=DB::table("materiales")->select("*")->get();
        $procedimientos=DB::table("procedimientos")->select("*")->get();
        $materiales_procedimientos=DB::table("materiales_procedimientos")->select("*")->get();

        return view('Procedimiento.procedimiento',compact("materiales","procedimientos","materiales_procedimientos"));
    }

    public function save_procedimiento(Request $request){
        date_default_timezone_set('America/Mexico_City');
        try {
            echo $request;

            DB::table("procedimientos")->insert([
                "nombre"=>$request['nombre'],
                "costo"=>$request['costo'],
                "costo_publico"=>$request['costo_public'],
                "porcentaje"=>$request['porcentaje'],
                "fecha"=>date("Y-m-d"),
            ]);
             echo "1";
            //odtenemos el id del registro servicios para ligarlo con los vehiculos agregados
            $id = DB::getPdo()->lastInsertId();

            for ($i=0; $i<=$request["numero_de_materiales"]; $i++) {

                if (isset($request["cantidad".$i])) {
                    DB::table("materiales_procedimientos")->insert([
                        "id_procedimiento"=>$id,
                        "id_material"=>$request["material".$i],
                        "usos"=>$request["cantidad".$i],
                    ]);
                }

            }

            return redirect()->back()->with(['message' => "Se Guardo Correctamente el Procedimiento", 'color' => 'info']);
            
        } catch (\Exception $e) {
            echo "algo salio mal";
            
        }

    }


    public function update_procedimiento(Request $request){

        try {

            DB::table("procedimientos")->where("id",$request['id_procedimiento'])->update([
                "nombre"=>$request['nombre_edit'],
                "costo"=>$request['costo_edit'],
                "costo_publico"=>$request['costo_public_edit'],
                "porcentaje"=>$request['porcentaje_edit'],
            ]);

            DB::table("materiales_procedimientos")->where("id_procedimiento",$request['id_procedimiento'])->delete();

            for ($i=0; $i<=$request["numero_de_materiales_edit"]; $i++) {

                if (isset($request["cantidad_edit".$i])) {
                    DB::table("materiales_procedimientos")->insert([
                        "id_procedimiento"=>$request['id_procedimiento'],
                        "id_material"=>$request["material_edit".$i],
                        "usos"=>$request["cantidad_edit".$i],
                    ]);
                }

            }

            return redirect()->back()->with(['message' => "Se Actualizo Correctamente el Procedimiento", 'color' => 'info']);
            
        } catch (\Exception $e) {
            echo "algo salio mal";
            
        }

    }

    public function delete_procedimiento(Request $request){

        try {

            if ($request['id_procedimiento_delete']!=0) {
                DB::table("procedimientos")->where("id",$request['id_procedimiento_delete'])->delete();
            }
            

            return redirect()->back()->with(['message' => "Se Elimino Correctamente el Procedimiento", 'color' => 'info']);
            
        } catch (\Exception $e) {
            echo "algo salio mal";
            
        }

    }
}
