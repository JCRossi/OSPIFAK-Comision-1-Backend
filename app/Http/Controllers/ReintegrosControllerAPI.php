<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Medico;
use Illuminate\Http\Request;
use App\Models\Reintegro;

class ReintegrosControllerAPI extends Controller
{
    public function getReintegrosByClient($clienteUsuario)
    {   
       // $userRequesting = $request->user('clientes');
       //$userRequesting = $request->clienteUsuario;
        if ($clienteUsuario){
            //$clienteId = $userRequesting->id;
            //$clienteId = $request->user('clientes')->id;
            //$reintegrosCliente = Reintegro::where('cliente_id', $clienteId)->get();
            $reintegrosCliente = Reintegro::join('clientes', 'reintegros.cliente_id', '=', 'clientes.id')
            ->where('clientes.usuario', $clienteUsuario)->get();

            return $this->responseOrError($reintegrosCliente, 'Reintegros no encontrados para ese cliente.');
        }
        return response()->json(['error' => 'Solicitud invalida'], 500);
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
                
                'cliente_usuario' => 'required|string|max:50',
                'medico_nombre' => 'required|string|max:50',
                'nombre_instituto' => 'required|string|max:50',
                'fecha_estudio_compra' => 'required|date',
                'matricula' => 'required|string|max:50',
                'cbu' => 'required|string|max:100',
                'orden_medica' => 'required|file|mimes:pdf',
                //'factura' =>  'required|file|mimes:pdf',
                //'tipo_reintegro' => 'required',
            ], 
            [
                'cliente_usuario.required' => 'El usuario del cliente no puede ser vacío',
                'cliente_usuario.string' => 'El usuario del cliente no tiene el formato adecuado.',
                'cliente_usuario.max' => 'El usuario ingresado es más extenso de lo permitido (50 caracteres).',

                'medico_nombre.required' => 'El nombre del medico no puede ser vacío',
                'medico_nombre.string' => 'El nombre del medico no tiene el formato adecuado.',
                'medico_nombre.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',
                
                'nombre_instituto.required' => 'El nombre del instituto no puede ser vacío',
                'nombre_instituto.string' => 'El nombre del instituto no tiene el formato adecuado.',
                'nombre_instituto.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                'fecha_estudio_compra.required' => 'La fecha de estudio o compra no puede ser vacía.',
                'fecha_estudio_compra.date' => 'La fecha de estudio o compra no tiene el formato adecuado.',

                'matricula.required' => 'La matricula no puede ser vacío',
                'matricula.string' => 'La matricula ingresada no tiene el formato adecuado.',
                'matricula.max' => 'La matricula ingresada es más extensa de lo permitido (50 caracteres).',

                'cbu.required' => 'El CBU no puede ser vacío.',
                'cbu.string' => 'El CBU no tiene el formato adecuado.',
                'cbu.max' => 'El cbu ingresado es más extenso de lo permitido (100 caracteres).',

                'orden_medica.required' => 'La orden medica no puede ser vacia.',
                'orden_medica.file' => 'La orden medica debe ser un archivo.',
                'orden_medica.mimes' => 'El formato de la orden medica no es pdf.',
            ]
        );
            
        $clienteUsuario = $request->get('cliente_usuario');
        $cliente = Cliente::where('usuario', $clienteUsuario)->first();
        if ($cliente){
            $clienteId = $cliente->id;
        }
        else {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }
        
        $medicoNombre = $request->get('medico_nombre');
        $medicoMatricula = $request->get('matricula');
        $medico = Medico::where('nombre', $medicoNombre)->where('matricula', $medicoMatricula)->first();
        if ($medico){
            $medicoId = $medico->id;
        }
        else {
            return response()->json(['error' => 'Medico no encontrado'], 404);
        }

        $reintegro = new Reintegro();

        $reintegro->cliente_id = $clienteId;
        $reintegro->medico_id = $medicoId;
        $reintegro->nombre_instituto = $request->get('nombre_instituto');
        $reintegro->fecha_estudio_compra = $request->get('fecha_estudio_compra');
        $reintegro->cbu = $request->get('cbu');

        $ordenMedicaPath = $request->file('orden_medica')->store('ordenes_medicas', 'public');
        $reintegro->orden_medica = $ordenMedicaPath;

        $reintegro->factura = $ordenMedicaPath; // falta la factura
        $reintegro->estado = 'Pendiente';
        $reintegro->tipo_reintegro = 'insumo';

        $reintegro->save();
            
        return response()->json($reintegro, 200);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function responseOrError($recoveredDataObject, $message){
        if ($recoveredDataObject) {
            return response()->json($recoveredDataObject, 200);
        } else {
            return response()->json(['error' => $message], 404);
        }
    }
}
