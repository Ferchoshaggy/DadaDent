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

        return view('Procedimiento.procedimiento',compact("materiales"));
    }
}
