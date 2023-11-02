<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestacion;
use Barryvdh\DomPDF\Facade\Pdf;

class PrestacionesController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestacion::query();

        // Aplicar filtros
        if ($request->has('dni')) {
            $query->whereHas('cliente', function ($subquery) use ($request) {
                $subquery->where('dni', $request->input('dni'));
            });
        }

        if ($request->has('estado')) {
            $query->where('estado', $request->input('estado'));
        }

        if ($request->has('desde')) {
            $query->whereDate('created_at', '>=', $request->input('desde'));
        }

        if ($request->has('hasta')) {
            $query->whereDate('created_at', '<=', $request->input('hasta'));
        }

        $prestaciones = $query->get();
        
        return view('solicitudes/prestaciones/index')->with('prestaciones', $prestaciones);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("solicitudes/prestaciones/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $request->validate(
                [
                    'cliente_id' => 'required|integer|max:50',
                    'nombre_medico' => 'required|string|max:50',
                    'matricula_medico' => 'required|string|max:50',
                    'instituto' => 'required|string|max:50',
                    'fecha_turno' => 'required|date',
                    'fecha_solicitud' => 'required|date',
                    'estado' => 'required|string|max:20',
                    'nombre_prestacion' => 'required',
                ],
                [
                    'cliente_id.required' => 'El id del cliente no puede ser vacío',
                    'cliente_id.integer' => 'El id no tiene el formato adecuado.',
                    'cliente_id.max' => 'El id ingresado es más extenso de lo permitido (50 caracteres).',

                    'nombre_medico.required' => 'El nombre no puede ser vacío',
                    'nombre_medico.string' => 'El nombre no tiene el formato adecuado.',
                    'nombre_medico.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                    'matricula_medico.required' => 'El nombre no puede ser vacío',
                    'matricula_medico.string' => 'El nombre no tiene el formato adecuado.',
                    'matricula_medico.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                    'instituto.required' => 'El nombre no puede ser vacío',
                    'instituto.string' => 'El nombre no tiene el formato adecuado.',
                    'instituto.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                    'fecha_turno.required' => 'La fecha de turno no puede ser vacía.',
                    'fecha_turno.date' => 'La fecha de turno no tiene el formato adecuado.',

                    'fecha_solicitud.required' => 'La fecha de solicitud no puede ser vacía.',
                    'fecha_solicitud.date' => 'La fecha de solicitud no tiene el formato adecuado.',

                    'factura.required' => 'La fecha no puede ser vacia.',
                    'factura.date' => 'La fecha de la factura debe ser una fecha vaida.',

                    'estado.required' => 'El estado no puede ser vacío',
                    'estado.string' => 'El estado no tiene el formato adecuado.',
                    'estado.max' => 'El estado ingresado es más extenso de lo permitido (20 caracteres).',

                    'nombre_prestacion.required' => 'La prestacion no puede ser vacia',
                ]
            );

            $prestacion = new Prestacion();
            $prestacion -> cliente_id = $request -> get('cliente_id'); 
            $prestacion -> nombre_medico = $request -> get('nombre_medico'); 
            $prestacion -> matricula_medico = $request -> get('matricula_medico'); 
            $prestacion -> instituto = $request -> get('instituto'); 
            $prestacion -> fecha_turno = $request -> get('fecha_turno'); 
            $prestacion -> fecha_solicitud = $request -> get('fecha_solicitud'); 
            $prestacion -> estado = $request -> get('estado'); 
            $prestacion -> nombre_prestacion = $request -> get('nombre_prestacion'); 
            $prestacion->save();
            
        return redirect()->to('solicitudes/prestaciones')->with('success', 'Prestación solicitada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404);
        }

        $prestacion = Prestacion::find($id);

        if (!$prestacion) {
            abort(404);
        }

        return view('solicitudes/prestaciones/show')->with('prestacion', $prestacion);
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
    public function update(Request $request, string $id, string $estado)
    {
        $prestacion = Prestacion::findOrFail($id);
        $prestacion->estado = $estado;
        $prestacion->save();

        return redirect()->to('solicitudes/prestaciones')->with('success', 'Estado de la prestación con id ' . ($id) . ' cambiado a ' . ($estado) . ' con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function generarPdf($id)
    {
        $prestacion = Prestacion::find($id);

        $pdf = PDF::loadView('solicitudes/prestaciones/pdf', compact('prestacion')); // Asegúrate de tener una vista llamada 'solicitudes/prestaciones/pdf' que represente el contenido del PDF para las prestaciones.

        return $pdf->stream();
    }


}
