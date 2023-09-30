<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PlanController;
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
    return view('welcome');
});

// esto va rodeado por middleware del login despues
Route::resource('empleados',EmpleadoController::class);
Route::resource('planes',PlanController::class);