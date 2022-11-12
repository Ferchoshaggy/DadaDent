<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
   public function __construct(){
        $this->middleware('auth');
   }

   public function materialSearch($id){
       $datosMat=DB::table('materiales')->where("id",$id)->first();
       return json_encode($datosMat);
   }
   public function all_materiales(){
      $allmat=DB::table('materiales')->select("*")->get();
       return json_encode($allmat);
   }

   public function all_procedimientos(){
      $allproce=DB::table('procedimientos')->select("*")->get();
       return json_encode($allproce);
   }

   public function procedimiento_materialSearch($id){
      ini_set('max_execution_time', 50000);
      $materiales_pro[0]=DB::table('procedimientos')->where("id",$id)->first();
      $materiales_pro[1]=DB::table('materiales_procedimientos')->where("id_procedimiento",$id)->get();
      return json_encode($materiales_pro);
   }

   public function procedimientoSearch($id){
      $procedimiento_result=DB::table('procedimientos')->where("id",$id)->first();
      return json_encode($procedimiento_result);
   }

   public function Superior_Permanentes(){

      $dientes_result=DB::table('perma_supers')->select("*")->get();
      return json_encode($dientes_result);


   }
   public function Inferior_Permanentes(){

      $dientes_result=DB::table('perma_infers')->select("*")->get();
      return json_encode($dientes_result);


   }
   public function Superior_Temporales(){

      $dientes_result=DB::table('tempo_supers')->select("*")->get();
      return json_encode($dientes_result);


   }
   public function Inferior_Temporales(){

      $dientes_result=DB::table('tempo_infers')->select("*")->get();
      return json_encode($dientes_result);


   }
   public function Superior_Mixta(){

      $dientes_result[0]=DB::table('perma_supers')->select("*")->get();
      $dientes_result[1]=DB::table('tempo_supers')->select("*")->get();
      return json_encode($dientes_result);


   }
   public function Inferior_Mixta(){

      $dientes_result[0]=DB::table('perma_infers')->select("*")->get();
      $dientes_result[1]=DB::table('tempo_infers')->select("*")->get();
      return json_encode($dientes_result);


   }

   public function procedimientos_presupuesto($id){
      $procedimientos_pre[0]=DB::table('presupuestos')->where("id",$id)->first();
      $procedimientos_pre[1]=DB::table('presupuestos_procedimientos')->where("id_presupuesto",$id)->get();
      return json_encode($procedimientos_pre);
   }

}
