<?php

use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoberturasController;

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
Route::resource('coberturas',CoberturasController::class);