<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\ProcedimientosController;
use App\Http\Controllers\MaterialesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//home
Route::get('/dashboard',[HomeController::class,'vista_dash'])->name('dashboard');

//presupuesto
Route::get('/presupuesto',[PresupuestoController::class,'vista_pres'])->name('presupuesto');

//procedimientos
Route::get('/procedimiento',[ProcedimientosController::class,'vista_proce'])->name('procedimiento');

//Materiales
Route::get('/materiales',[MaterialesController::class,'vista_mate'])->name('materiales');
Route::post('/save_material',[MaterialesController::class,'save_mate'])->name('save_mate');
