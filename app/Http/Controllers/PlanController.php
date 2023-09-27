<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Cobertura;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("plan.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate(
                [
                    'nombre' => 'required|string|max:10',   
                    'precio_jovenes' => 'required|integer|min:0|max:99999999',
                    'precio_adultos_jovenes' => 'required|integer|min:0|max:99999999',
                    'precio_adultos' => 'required|integer|min:0|max:99999999',
                    'precio_adultos_mayores' => 'required|integer|min:0|max:99999999',
                    'coberturas' => 'required|array|min:1',    
                    'coberturas.*.nombre_prestacion' => 'required|string',  
                    'coberturas.*.porcentaje' => 'required|integer|min:0|max:100',
                ],
                [
                    'nombre.required' => 'El nombre no puede ser vacío',
                    'nombre.string' => 'El nombre no tiene el formato adecuado.',
                    'nombre.max' => 'El nombre ingresado es más extenso de lo permitido (10 caracteres).',
                    
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
                    'precio_adultos_mayores.max' => 'El precio de mayores de 55 debe ser como máximo de 8 dígitos.',

                    'coberturas.required' => 'Debe haber al menos una cobertura en el plan',    
                    'coberturas.array' => 'Las coberturas no tienen el formato adecuado',  
                    
                    'coberturas.*.nombre_prestacion.required' => 'El nombre de la prestación no puede ser vacío',
                    'coberturas.*.nombre_prestacion.string' => 'El nombre de la prestación no tiene el formato adecuado.',
                
                    'coberturas.*.porcentaje.required' => 'El porcentaje de la prestación no puede ser vacío.',
                    'coberturas.*.porcentaje.integer' => 'El porcentaje de la prestación no tiene el formato adecuado.',
                    'coberturas.*.porcentaje.min' => 'El porcentaje ingresado debe encontrarse entre 0 y 100.',
                    'coberturas.*.porcentaje.max' => 'El porcentaje ingresado debe encontrarse entre 0 y 100.',
                ]
            );

            $plan = new Plan();
            $plan->nombre = $request->nombre;
            $plan->precio_jovenes = $request->precio_jovenes;
            $plan->precio_adultos_jovenes = $request->precio_adultos_jovenes;
            $plan->precio_adultos = $request->precio_adultos;
            $plan->precio_adultos_mayores = $request->precio_adultos_mayores;

            $plan->save();

            foreach ($request->coberturas as $detalle) {
                $cobertura = new Cobertura();
                $cobertura->id_plan = $plan->id;
                $cobertura->nombre_prestacion = $detalle['nombre_prestacion'];
                $cobertura->porcentaje = $detalle['porcentaje'];
                $cobertura->save();
                $cobertura->setHidden(['created_at', 'updated_at']);
            }
            
            $compra->setHidden(['created_at', 'updated_at']);
        }
        catch(ValidationException $e){
            $errors = $e->validator->errors()->all();
            
            return redirect()->back()->withInput()->withErrors($errors);
        }
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
