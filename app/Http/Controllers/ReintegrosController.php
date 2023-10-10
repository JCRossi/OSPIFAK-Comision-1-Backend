<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reintegro;

class ReintegrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reintegros = Reintegro::all();
        return view('solicitudes/reintegros/index')->with('reintegros', $reintegros);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("solicitudes/reintegros/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $request->validate(
                [
                    'cliente_id' => 'required|integer|max:50',
                    'medico_id' => 'required|integer|max:50',
                    'nombre_instituto' => 'required|string|max:50',
                    'fecha_solicitud' => 'required|date',
                    'cbu' => 'required|string|max:100',
                    'orden_medica' => 'required|file|mimes:pdf',
                    'factura' => 'required|date',
                    'estado' => 'required|string|max:20',
                    'tipo_reintegro' => 'required',
                ],
                [
                    'cliente_id.required' => 'El id del cliente no puede ser vacío',
                    'cliente_id.integer' => 'El id no tiene el formato adecuado.',
                    'cliente_id.max' => 'El id ingresado es más extenso de lo permitido (50 caracteres).',

                    'medico_id.required' => 'El id del medico no puede ser vacío',
                    'medico_id.integer' => 'El id no tiene el formato adecuado.',
                    'medico_id.max' => 'El id ingresado es más extenso de lo permitido (50 caracteres).',
                    
                    'nombre_instituto.required' => 'El nombre no puede ser vacío',
                    'nombre_instituto.string' => 'El nombre no tiene el formato adecuado.',
                    'nombre_instituto.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                    'fecha_solicitud.required' => 'La fecha de nacimiento no puede ser vacía.',
                    'fecha_solicitud.date' => 'La fecha de nacimiento no tiene el formato adecuado.',

                    'cbu.required' => 'El CBU no puede ser vacío.',
                    'cbu.string' => 'El nombre no tiene el formato adecuado.',
                    'cbu.max' => 'El cbu ingresado es más extenso de lo permitido (100 caracteres).',

                    'orden_medica.required' => 'La orden medica no puede se vacia.',
                    'orden_medica.file' => 'La orden medica debe ser un archivo.',
                    'orden_medica.mimes' => 'El formato de la orden es incorrecto.',

                    'factura.required' => 'La fecha no puede ser vacia.',
                    'factura.date' => 'La fecha de la factura debe ser una fecha vaida.',

                    'estado.required' => 'El estado no puede ser vacío',
                    'estado.string' => 'El estado no tiene el formato adecuado.',
                    'estado.max' => 'El estado ingresado es más extenso de lo permitido (20 caracteres).',

                    'tipo_reintegro.required' => 'El tipo de reintegro no puede ser vacio',
                ]
            );

            $reintegro = new Reintegro();
            $reintegro -> cliente_id = $request -> get('cliente_id'); 
            $reintegro -> medico_id = $request -> get('medico_id'); 
            $reintegro -> nombre_instituto = $request -> get('nombre_instituto'); 
            $reintegro -> fecha_solicitud = $request -> get('fecha'); 
            $reintegro -> cbu = $request -> get('cbu'); 
            $reintegro -> orden_medica = $request -> get('orden_medica'); 
            $reintegro -> factura = $request -> get('factura'); 
            $reintegro -> estado = $request -> get('estado');
            $reintegro -> tipo_reintegro = $request -> get('tipo_reintegro'); 

            $reintegro->save();
            
        return redirect()->to('solicitudes/reintegros')->with('success', 'Reintegro solicitado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404);
        }

        $reintegro = Reintegro::find($id);

        if (!$reintegro) {
            abort(404);
        }

        return view('solicitudes/reintegros/show')->with('reintegro', $reintegro);
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
