<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Menor;
use App\Models\SolicitudBaja;
use Illuminate\Http\Request;

class SolicitudesBajaControllerAPI extends Controller
{
    public function index(string $usuario)
{
    $cliente = Cliente::where('usuario', $usuario)->first();

    if (!$cliente) {
        return response()->json(['message' => 'Cliente no encontrado'], 405);
    }

    $titularData = SolicitudBaja::leftJoin('clientes', 'solicitudes_baja.cliente_id', '=', 'clientes.id')
        ->where('solicitudes_baja.paciente_tipo', '=', 'titular')
        ->select('solicitudes_baja.*', 'clientes.apellido', 'clientes.dni', 'clientes.nombre')
        ->get();

    $menoresData = SolicitudBaja::leftJoin('cliente_menor', 'solicitudes_baja.paciente_id', '=', 'cliente_menor.id')
        ->leftJoin('clientes', 'solicitudes_baja.cliente_id', '=', 'clientes.id')
        ->where('solicitudes_baja.paciente_tipo', '=', 'menor')
        ->select('solicitudes_baja.*', 'cliente_menor.apellido', 'cliente_menor.dni', 'cliente_menor.nombre')
        ->get();

    $response = [
        'titularData' => $titularData,
        'menoresData' => $menoresData,
    ];

    return response()->json($response);
}

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'cliente_usuario' => 'required|string|max:50',
                'paciente_nombre' => 'required|string|max:50',
            ], 
            [
                'cliente_usuario.required' => 'El usuario del cliente no puede ser vacío',
                'cliente_usuario.string' => 'El usuario del cliente no tiene el formato adecuado.',
                'cliente_usuario.max' => 'El usuario ingresado es más extenso de lo permitido (50 caracteres).',

                'paciente_nombre.required' => 'El nombre del paciente no puede ser vacío',
                'paciente_nombre.string' => 'El nombre del paciente no tiene el formato adecuado.',
                'paciente_nombre.max' => 'El nombre del paciente es más extenso de lo permitido (50 caracteres).',
            ]
        );

        $clienteSolicitudBaja = Cliente::where('usuario', $request->get('cliente_usuario'))->first();
        $pacienteNombre = $request->get('paciente_nombre');

        $paciente = Cliente::where('nombre', $pacienteNombre)->first();
        if ($paciente){
            $pacienteId = $paciente->id;
            $tipoPaciente = 'titular';
        }
        else {
            $paciente = Menor::where('nombre', $pacienteNombre)->first();
            if ($paciente){
                $pacienteId = $paciente->id;
                $tipoPaciente = 'menor';
            }
            else {
                return response()->json(['error' => 'Cliente no encontrado'], 404);
            }
        }
       

        $solicitudBaja = new SolicitudBaja();

        $solicitudBaja->paciente_tipo = $tipoPaciente;
        $solicitudBaja->cliente_id = $clienteSolicitudBaja->id;
        $solicitudBaja->paciente_id = $pacienteId;
        $solicitudBaja->estado = 'Pendiente';

        if ($request->has('comentarios')){
            $solicitudBaja->comentarios = $request->get('comentarios');
        }

        $solicitudBaja->save();
            
        return response()->json($solicitudBaja, 200);
    }
}


