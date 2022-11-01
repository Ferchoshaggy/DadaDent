<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcedimientosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vista_proce(){
        return view('Procedimiento.procedimiento');
    }
}
