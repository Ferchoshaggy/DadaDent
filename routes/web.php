<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\ProcedimientosController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\SearchController;

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
Route::get('/pdf_materiales',[HomeController::class,'pdf_materiales'])->name('pdf_materiales');
Route::get('/pdf_procedimientos',[HomeController::class,'pdf_procedimientos'])->name('pdf_procedimientos');

//presupuesto
Route::get('/presupuesto',[PresupuestoController::class,'vista_pres'])->name('presupuesto');
Route::get("/procedimientoSearch/{id}",[SearchController::class,'procedimientoSearch'])->name('procedimientoSearch');
Route::get("/Superior_Permanentes",[SearchController::class,'Superior_Permanentes'])->name('Superior_Permanentes');
Route::get("/Inferior_Permanentes",[SearchController::class,'Inferior_Permanentes'])->name('Inferior_Permanentes');
Route::get("/Superior_Temporales",[SearchController::class,'Superior_Temporales'])->name('Superior_Temporales');
Route::get("/Inferior_Temporales",[SearchController::class,'Inferior_Temporales'])->name('Inferior_Temporales');
Route::get("/Superior_Mixta",[SearchController::class,'Superior_Mixta'])->name('Superior_Mixta');
Route::get("/Inferior_Mixta",[SearchController::class,'Inferior_Mixta'])->name('Inferior_Mixta');
Route::post("/save_presupuesto",[PresupuestoController::class,'save_presupuesto'])->name('save_presupuesto');
Route::get("/procedimientos_presupuesto/{id}",[SearchController::class,'procedimientos_presupuesto'])->name('procedimientos_presupuesto');
Route::post("/update_presupuesto",[PresupuestoController::class,'update_presupuesto'])->name('update_presupuesto');
Route::delete('/delete_presupuesto',[PresupuestoController::class,'delete_presupuesto'])->name('delete_presupuesto');
Route::get('/pdf_interno/{id}',[PresupuestoController::class,'pdf_interno'])->name('pdf_interno');
Route::get('/pdf_externo/{id}',[PresupuestoController::class,'pdf_externo'])->name('pdf_externo');

//procedimientos
Route::get('/procedimiento',[ProcedimientosController::class,'vista_proce'])->name('procedimiento');
Route::post('/save_procedimiento',[ProcedimientosController::class,'save_procedimiento'])->name('save_procedimiento');
Route::get("/procedimiento_materialSearch/{id}",[SearchController::class,'procedimiento_materialSearch'])->name('procedimiento_materialSearch');
Route::post('/update_procedimiento',[ProcedimientosController::class,'update_procedimiento'])->name('update_procedimiento');
Route::delete('/delete_procedimiento',[ProcedimientosController::class,'delete_procedimiento'])->name('delete_procedimiento');

//Materiales
Route::get('/materiales',[MaterialesController::class,'vista_mate'])->name('materiales');
Route::post('/save_material',[MaterialesController::class,'save_mate'])->name('save_mate');
Route::get("/search_material/{id}",[SearchController::class,'materialSearch'])->name('materialSearch');
Route::delete('/delete_material',[MaterialesController::class,'mate_delete'])->name('mate_delete');
Route::post('/update_material',[MaterialesController::class,'mate_update'])->name('mate_update');
