<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vista_pres(){
        return view('Presupuesto.presupuesto');
    }
}
