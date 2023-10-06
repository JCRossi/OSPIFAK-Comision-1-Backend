<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Cobertura;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PlanController extends Controller
{
    function _construct(){
        $this->middleware('can:planes.index')->only('index');
        $this->middleware('can:planes.create')->only('create','store');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("planes/index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("planes/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $request->validate(
                [
                    'nombre' => 'required|string|max:10|unique:plans,nombre',   
                    'precio_jovenes' => 'required|integer|min:0|max:99999999',
                    'precio_adultos_jovenes' => 'required|integer|min:0|max:99999999',
                    'precio_adultos' => 'required|integer|min:0|max:99999999',
                    'precio_adultos_mayores' => 'required|integer|min:0|max:99999999',

                ],
                [
                    'nombre.required' => 'El nombre no puede ser vacío',
                    'nombre.string' => 'El nombre no tiene el formato adecuado.',
                    'nombre.max' => 'El nombre ingresado es más extenso de lo permitido (10 caracteres).',
                    'nombre.unique' => 'Ya existe un plan con ese nombre.',
                    
                    'precio_jovenes.required' => 'El precio de menores de 21 no puede ser vacío',
                    'precio_jovenes.integer' => 'El precio de menores de 21 no tiene el formato adecuado',
                    'precio_jovenes.min' => 'El precio de menores de 21 tiene que ser positivo',
                    'precio_jovenes.max' => 'El precio de menores de 21 debe ser como máximo de 8 dígitos.',

                    'precio_adultos_jovenes.required' => 'El precio de entre 21 y 35 no puede ser vacío',
                    'precio_adultos_jovenes.integer' => 'El precio de entre 21 y 35 no tiene el formato adecuado',
                    'precio_adultos_jovenes.min' => 'El precio de entre 21 y 35 tiene que ser positivo',
                    'precio_adultos_jovenes.max' => 'El precio de entre 21 y 35 debe ser como máximo de 8 dígitos.',

                    'precio_adultos.required' => 'El precio de entre 35 y 55 no puede ser vacío',
                    'precio_adultos.integer' => 'El precio de entre 35 y 55 no tiene el formato adecuado',
                    'precio_adultos.min' => 'El precio de entre 35 y 55 tiene que ser positivo',
                    'precio_adultos.max' => 'El precio de entre 35 y 55 debe ser como máximo de 8 dígitos.',

                    'precio_adultos_mayores.required' => 'El precio de mayores de 55 no puede ser vacío',
                    'precio_adultos_mayores.integer' => 'El precio de mayores de 55 no tiene el formato adecuado',
                    'precio_adultos_mayores.min' => 'El precio de mayores de 55 tiene que ser positivo',
                    'precio_adultos_mayores.max' => 'El precio de mayores de 55 debe ser como máximo de 8 dígitos.'
                ]
            );
            
            $plan = new Plan();
            $plan->nombre = $request->nombre;
            $plan->precio_jovenes = $request->precio_jovenes;
            $plan->precio_adultos_jovenes = $request->precio_adultos_jovenes;
            $plan->precio_adultos = $request->precio_adultos;
            $plan->precio_adultos_mayores = $request->precio_adultos_mayores;

            $plan->save();

 
            
            $plan->setHidden(['created_at', 'updated_at']);

            return redirect()->to('/coberturas/create')->with('success', 'Plan dado de alta correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
