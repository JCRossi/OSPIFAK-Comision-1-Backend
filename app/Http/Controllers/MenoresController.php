<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Menor;
use Illuminate\Http\Request;

class MenoresController extends Controller
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
        return view("clienteMenor/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|string|max:50',
                'apellido' => 'required|string|max:50',
                'fecha_nacimiento' => 'required|date',
                'dni' => 'required|numeric|min:1|max:99999999',
                'telefono' => 'required|numeric',
            ],
            [
                'nombre.required' => 'El nombre no puede ser vacío',
                'nombre.string' => 'El nombre no tiene el formato adecuado.',
                'nombre.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                'apellido.required' => 'El apellido no puede ser vacío',
                'apellido.string' => 'El apellido no tiene el formato adecuado.',
                'apellido.max' => 'El apellido ingresado es más extenso de lo permitido (50 caracteres).',
                
                'fecha_nacimiento.required' => 'La fecha de nacimiento no puede ser vacía.',
                'fecha_nacimiento.date' => 'La fecha de nacimiento no tiene el formato adecuado.',

                'dni.required' => 'El DNI no puede ser vacío.',
                'dni.numeric' => 'El DNI no tiene el formato adecuado.',
                'dni.min' => 'El DNI ingresado tiene que ser mayor que 0.',
                'dni.max' => 'El DNI ingresado es más extenso de lo permitido (8 dígitos).',

                'telefono.required' => 'El telefono no puede ser vacío',
                'telefono.numeric' => 'El telefono no tiene el formato adecuado.', 
            ]
        );

        $cliente = new Cliente();

        $cliente -> usuario = $request -> get('dni'); 
        $cliente -> password = $request -> get('dni'); 
        $cliente -> nombre = $request -> get('nombre'); 
        $cliente -> apellido = $request -> get('apellido'); 
        $cliente -> fecha_nacimiento = $request -> get('fecha_nacimiento'); 
        $cliente -> dni = $request -> get('dni'); 
        $cliente -> email = $request -> get('email'); 
        $cliente -> direccion = $request -> get('direccion'); 
        $cliente -> telefono = $request -> get('telefono'); 
        $cliente -> plan = $request -> get('plan'); 

        $menor = new Menor();

        $menor->id_cliente = 9999;
        $menor->nombre = $request -> get('nombre'); 
        $menor->apellido = $request -> get('apellido'); 
        $menor->fecha_nacimiento = $request -> get('fecha_nacimiento'); 
        $menor->dni = $request -> get('dni');
        $menor->telefono = $request -> get('telefono'); 

        $menor->save();
    
        return redirect()->back()->with('success', 'Menor dado de alta con éxito');
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
