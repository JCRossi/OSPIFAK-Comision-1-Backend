<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;

class MedicosController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $request->validate(
                [
                    'nombre' => 'required|string|max:50',
                    'matricula' => 'required|string|max:50',
                ],
                [
                    'nombre.required' => 'El nombre no puede ser vacío',
                    'nombre.string' => 'El nombre no tiene el formato adecuado.',
                    'nombre.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                    'matricula.required' => 'La matricula no puede ser vacía',
                    'matricula.string' => 'La matricula no tiene el formato adecuado.',
                    'matricula.max' => 'La matricula ingresada es más extensa de lo permitido (50 caracteres).',
                ]
            );

            $medico = new Medico();
            $medico -> nombre = $request -> get('nombre'); 
            $medico -> matricula = $request -> get('matricula'); 

            $medico->save();

        return redirect()->to('medicos')->with('success', 'Medico dado de alta con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

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