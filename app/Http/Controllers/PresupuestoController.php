<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
class PresupuestoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vista_pres(){
        $generos=DB::table("generos")->select("*")->get();
        $tipos=DB::table("tipos")->select("*")->get();
        $ubicacions=DB::table("ubicacions")->select("*")->get();
        /*
        $perma_supers=DB::table("perma_supers")->select("*")->get();
        $perma_infers=DB::table("perma_infers")->select("*")->get();
        $tempo_supers=DB::table("tempo_supers")->select("*")->get();
        $tempo_infers=DB::table("tempo_infers")->select("*")->get();
        */
        $procedimientos=DB::table("procedimientos")->select("*")->get();
        $presupuestos=DB::table("presupuestos")->select("*")->get();
        
        return view('Presupuesto.presupuesto',compact("generos","tipos","ubicacions","procedimientos","presupuestos"));
    }

    function save_presupuesto(Request $request){
        date_default_timezone_set('America/Mexico_City');

        try {
            echo $request;

            DB::table("presupuestos")->insert([
                "nombre"=>$request['nombre'],
                "id_sexo"=>$request['sexo'],
                "id_tipo"=>$request['tipo'],
                "edad"=>$request['edad'],
                "invercion"=>$request['importe_to'],
                "costo_publico"=>$request['costo_pu'],
                "utilidad"=>$request['utilidad'],
                "porcentaje"=>$request['porcentaje_ga'],
                "observaciones"=>$request['observacion'],
                "fecha"=>date("Y-m-d"),
            ]);
            //odtenemos el id del registro servicios para ligarlo con los vehiculos agregados
            $id = DB::getPdo()->lastInsertId();
            for ($i=0; $i<=$request["numero_de_procedimientos"]; $i++) {

                if (isset($request["procedimiento".$i])) {
                    DB::table("presupuestos_procedimientos")->insert([
                        "id_presupuesto"=>$id,
                        "id_ubicacion"=>$request['ubicacion'.$i],
                        "numero_asignado_pz"=>$request['pz'.$i],
                        "id_procedimiento"=>$request['procedimiento'.$i],
                        "descuento"=>$request['descuento'.$i],

                    ]);
                }

            }

            return redirect()->back()->with(['message' => "Se Guardo Correctamente el Presupuesto", 'color' => 'info']);
            
        } catch (\Exception $e) {
            echo "algo salio mal";
            
        }
    }

    function update_presupuesto(Request $request){
        date_default_timezone_set('America/Mexico_City');

        try {

            DB::table("presupuestos")->where("id",$request['id_presupuesto_edit'])->update([
                "nombre"=>$request['nombre_edit'],
                "id_sexo"=>$request['sexo_edit'],
                "id_tipo"=>$request['tipo_edit'],
                "edad"=>$request['edad_edit'],
                "invercion"=>$request['importe_to_edit'],
                "costo_publico"=>$request['costo_pu_edit'],
                "utilidad"=>$request['utilidad_edit'],
                "porcentaje"=>$request['porcentaje_ga_edit'],
                "observaciones"=>$request['observacion_edit'],
            ]);

            DB::table("presupuestos_procedimientos")->where("id_presupuesto",$request['id_presupuesto_edit'])->delete();

            for ($i=0; $i<=$request["numero_de_procedimientos_edit"]; $i++) {

                if (isset($request["procedimiento_edit".$i])) {
                    DB::table("presupuestos_procedimientos")->insert([
                        "id_presupuesto"=>$request['id_presupuesto_edit'],
                        "id_ubicacion"=>$request['ubicacion_edit'.$i],
                        "numero_asignado_pz"=>$request['pz_edit'.$i],
                        "id_procedimiento"=>$request['procedimiento_edit'.$i],
                        "descuento"=>$request['descuento_edit'.$i],

                    ]);
                }

            }

            return redirect()->back()->with(['message' => "Se Actualizo Correctamente el Presupuesto", 'color' => 'info']);
            
        } catch (\Exception $e) {
            echo "algo salio mal";
            
        }
    }

    public function delete_presupuesto(Request $request){
        try {

            if ($request['id_presupuesto_delete']!=0) {
                DB::table("presupuestos")->where("id",$request['id_presupuesto_delete'])->delete();
            }
            

            return redirect()->back()->with(['message' => "Se Elimino Correctamente el Presupuesto", 'color' => 'info']);
            
        } catch (\Exception $e) {
            echo "algo salio mal";
            
        }
    }

    public function pdf_interno($id){
        date_default_timezone_set('America/Mexico_City');
        $presupuestos_procedimientos=DB::table("presupuestos_procedimientos")->where("id_presupuesto",$id)->get();
        $procedimientos=DB::table("procedimientos")->select("*")->get();
        $presupuesto=DB::table("presupuestos")->where("id",$id)->first();
        $perma_supers=DB::table("perma_supers")->select("*")->get();
        $perma_infers=DB::table("perma_infers")->select("*")->get();
        $tempo_supers=DB::table("tempo_supers")->select("*")->get();
        $tempo_infers=DB::table("tempo_infers")->select("*")->get();
        $pdf = PDF::loadView('Presupuesto.pdf_interno',compact("presupuestos_procedimientos","procedimientos","presupuesto","perma_supers","perma_infers","tempo_supers","tempo_infers",))->setPaper(array(0,0,612.00,792.00));

        return $pdf->stream("presupuesto-".date("d-m-Y").".pdf");
    }

    public function pdf_externo($id){
        date_default_timezone_set('America/Mexico_City');
        $presupuestos_procedimientos=DB::table("presupuestos_procedimientos")->where("id_presupuesto",$id)->get();
        $procedimientos=DB::table("procedimientos")->select("*")->get();
        $presupuesto=DB::table("presupuestos")->where("id",$id)->first();
        $perma_supers=DB::table("perma_supers")->select("*")->get();
        $perma_infers=DB::table("perma_infers")->select("*")->get();
        $tempo_supers=DB::table("tempo_supers")->select("*")->get();
        $tempo_infers=DB::table("tempo_infers")->select("*")->get();
        $pdf = PDF::loadView('Presupuesto.pdf_externo',compact("presupuestos_procedimientos","procedimientos","presupuesto","perma_supers","perma_infers","tempo_supers","tempo_infers",))->setPaper(array(0,0,612.00,792.00));

        return $pdf->stream("presupuesto-".date("d-m-Y").".pdf");
    }
}
