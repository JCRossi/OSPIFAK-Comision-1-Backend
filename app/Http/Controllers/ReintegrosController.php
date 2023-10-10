<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reintegro;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ReintegrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reintegros/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("reintegros/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $request->validate(
                [
                    'cliente_nombre' => 'required|string|max:50',
                    'medico_nombre' => 'required|string|max:50',
                    'medico_matricula' => 'required|string|max:50',
                    'nombre_instituto' => 'required|string|max:50',
                    'fecha' => 'required|date',
                    'cbu' => 'required|string|max:100',
                    'orden_medica' => 'required|file|mimes:pdf',
                    'factura' => 'required|date',
                    'tipo_reintegro' => 'required',
                ],
                [
                    'cliente_nombre.required' => 'El nombre no puede ser vacío',
                    'cliente_nombre.string' => 'El nombre no tiene el formato adecuado.',
                    'cliente_nombre.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                    'medico_nombre.required' => 'El nombre no puede ser vacío',
                    'medico_nombre.string' => 'El nombre no tiene el formato adecuado.',
                    'medico_nombre.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',
                    
                    'medico_matricula.required' => 'La matricula no puede ser vacío',
                    'medico_matricula.string' => 'La matricula no tiene el formato adecuado.',
                    'medico_matricula.max' => 'La matricula ingresado es más extenso de lo permitido (50 caracteres).',
                    
                    'nombre_instituto.required' => 'El nombre no puede ser vacío',
                    'nombre_instituto.string' => 'El nombre no tiene el formato adecuado.',
                    'nombre_instituto.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                    'fecha.required' => 'La fecha de nacimiento no puede ser vacía.',
                    'fecha.date' => 'La fecha de nacimiento no tiene el formato adecuado.',

                    'cbu.required' => 'El CBU no puede ser vacío.',
                    'cbu.string' => 'El nombre no tiene el formato adecuado.',
                    'cbu.max' => 'El cbu ingresado es más extenso de lo permitido (100 caracteres).',

                    'orden_medica.required' => 'La orden medica no puede se vacia.',
                    'orden_medica.file' => 'La orden medica debe ser un archivo.',
                    'orden_medica.mimes' => 'El formato de la orden es incorrecto.',

                    'factura.required' => 'La fecha no puede ser vacia.',
                    'factura.date' => 'La fecha de la factura debe ser una fecha vaida.',

                    'tipo_reintegro.required' => 'El tipo de reintegro no puede ser vacio',
                ]
            );

            $reintegro = new Reintegro();
            $reintegro -> cliente_nombre = $request -> get('cliente_nombre'); 
            $reintegro -> medico_nombre = $request -> get('medico_nombre'); 
            $reintegro -> medico_matricula = $request -> get('medico_matricula'); 
            $reintegro -> nombre_instituto = $request -> get('nombre_instituto'); 
            $reintegro -> fecha = $request -> get('fecha'); 
            $reintegro -> cbu = $request -> get('cbu'); 
            $reintegro -> orden_medica = $request -> get('orden_medica'); 
            $reintegro -> factura = $request -> get('factura'); 
            $reintegro -> tipo_reintegro = $request -> get('tipo_reintegro'); 

            $reintegro->save();
            
        return redirect()->to('/reintegros')->with('success', 'Reintegro solicitado con exito');
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
