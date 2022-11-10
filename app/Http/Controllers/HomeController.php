<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vista_dash(){
        return view('Home.vista');
    }

    public function pdf_materiales(){
        date_default_timezone_set('America/Mexico_City');
        $materiales=DB::table("materiales")->select("*")->get();
        $pdf = PDF::loadView('Home.pdf_materiales',compact("materiales"))->setPaper(array(0,0,612.00,792.00));
        //$nombre_pdf="Matriz Master_".$proyectos->nombre.".pdf";

        return $pdf->stream("materiales-".date("d-m-Y").".pdf");
    }

    public function pdf_procedimientos(){
        date_default_timezone_set('America/Mexico_City');
        $procedimientos=DB::table("procedimientos")->select("*")->get();
        $materiales=DB::table("materiales")->select("*")->get();
        $materiales_procedimientos=DB::table("materiales_procedimientos")->select("*")->get();
        $pdf = PDF::loadView('Home.pdf_procedimientos',compact("materiales","procedimientos","materiales_procedimientos"))->setPaper(array(0,0,612.00,792.00));
        //$nombre_pdf="Matriz Master_".$proyectos->nombre.".pdf";

        return $pdf->stream("procedimientos-".date("d-m-Y").".pdf");
    }

}
