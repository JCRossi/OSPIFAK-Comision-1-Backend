<?php

use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\MenoresController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard'); // deberia ir al login y luego de loguearse al dashboard, pero por ahora asi
});

// esto va rodeado por middleware del login despues
Route::resource('empleados',EmpleadosController::class);
Route::resource('planes',PlanController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('clienteMenor',MenoresController::class);