<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolicitudesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoberturasController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ReintegrosController;
use App\Http\Controllers\PrestacionesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ClientesMenoresController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::resource('empleados',EmpleadosController::class);
   // Route::delete('/empleados/delete/{id}', [EmpleadosController:: class, 'delete'])->name('empleados.delete');
    Route::delete('/empleados/{id}', [EmpleadosController::class,'destroy'])->name('empleados.destroy');
    Route::resource('planes',PlanController::class);
    Route::get('planes/{id}/delete', [PlanController::class, 'delete']);
    Route::resource('coberturas',CoberturasController::class);
    Route::resource('clientes',ClientesController::class);
    Route::resource('clientesMenores',ClientesMenoresController::class);
    Route::get('solicitudes', [SolicitudesController::class, 'index']);
    Route::resource('solicitudes/reintegros', ReintegrosController::class);
    Route::patch('solicitudes/reintegros/{id}/{estado}', [ReintegrosController::class, 'update'])->name('reintegros/update');
    Route::resource('solicitudes/prestaciones', PrestacionesController::class);
    Route::patch('solicitudes/prestaciones/{id}/{estado}', [PrestacionesController::class, 'update'])->name('prestaciones/update');
});

require __DIR__.'/auth.php';
