<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function materialSearch($id){
       $datosMat=DB::table('materiales')->where("id",$id)->first();
       return json_encode($datosMat);
    }

}
