<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Cobertura;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CoberturasController extends Controller
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
        $enumValues = [
        'Consultas medicas',
        'Consultas medicas domiciliarias',
        'Consulta medica online',
        'Internacion',
        'Odontologia general',
        'Ortodoncia',
        'Protesis odontologicas',
        'Implantes odontologicos',
        'Kinesiologia',
        'Psicologia',
        'Medicamentos en farmacia',
        'Medicamentos en internacion',
        'Optica',
        'Cirugias esteticas',
        'Analisis clinicos',
        'Analisis de diagnostico',
    ];
    
    return view('coberturas/create', compact('enumValues'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $enumValues = [
            'Consultas medicas',
            'Consultas medicas domiciliarias',
            'Consulta medica online',
            'Internacion',
            'Odontologia general',
            'Ortodoncia',
            'Protesis odontologicas',
            'Implantes odontologicos',
            'Kinesiologia',
            'Psicologia',
            'Medicamentos en farmacia',
            'Medicamentos en internacion',
            'Optica',
            'Cirugias esteticas',
            'Analisis clinicos',
            'Analisis de diagnostico',
        ];
        
        $porcentajes = $request->input('porcentaje');
            $request->validate(
                [
                    'porcentaje.*' => 'required|integer|min:0|max:100',
                ],
                [           
                    'porcentaje.*.required' => 'El porcentaje de la prestación no puede ser vacío.',
                    'porcentaje.*.integer' => 'El porcentaje de la prestación no tiene el formato adecuado.',
                    'porcentaje.*.min' => 'El porcentaje ingresado debe encontrarse entre 0 y 100.',
                    'porcentaje.*.max' => 'El porcentaje ingresado debe encontrarse entre 0 y 100.',
                ]
            );

            $planId = Plan::max('id');
            
            foreach ($enumValues as $index => $nombre_prestacion) {
                $cobertura = new Cobertura();
                $cobertura->plan_id = $planId;
                $cobertura->nombre_prestacion = $nombre_prestacion;
                $cobertura->porcentaje = $porcentajes[$index];
                $cobertura->save();
                $cobertura->setHidden(['created_at', 'updated_at']);
            }

            return redirect()->to('/planes')->with('success', 'Coberturas definidas correctamente');
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
   /* public function edit(string $id)
    {
        $enumValues = [
            'Consultas medicas',
            'Consultas medicas domiciliarias',
            'Consulta medica online',
            'Internacion',
            'Odontologia general',
            'Ortodoncia',
            'Protesis odontologicas',
            'Implantes odontologicos',
            'Kinesiologia',
            'Psicologia',
            'Medicamentos en farmacia',
            'Medicamentos en internacion',
            'Optica',
            'Cirugias esteticas',
            'Analisis clinicos',
            'Analisis de diagnostico',
        ];
        $cobertura = Cobertura::where('plan_id',$id)->get();
        //return view('Coberturas/edit')->with('cobertura', $cobertura);
        return view('Coberturas/edit', compact('enumValues', 'cobertura'));
    }*/
    public function edit(string $id)
{
    $enumValues = [
        'Consultas medicas',
        'Consultas medicas domiciliarias',
        'Consulta medica online',
        'Internacion',
        'Odontologia general',
        'Ortodoncia',
        'Protesis odontologicas',
        'Implantes odontologicos',
        'Kinesiologia',
        'Psicologia',
        'Medicamentos en farmacia',
        'Medicamentos en internacion',
        'Optica',
        'Cirugias esteticas',
        'Analisis clinicos',
        'Analisis de diagnostico',
    ];
    
    $planId = $id; // Obtén el ID del plan que deseas editar.
    $coberturas = Cobertura::where('plan_id', $planId)->get(); // Obtén las coberturas asociadas al plan.

    return view('coberturas/edit', compact('enumValues', 'coberturas', 'planId'));

}


    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
    {
        $enumValues = [
            'Consultas medicas',
            'Consultas medicas domiciliarias',
            'Consulta medica online',
            'Internacion',
            'Odontologia general',
            'Ortodoncia',
            'Protesis odontologicas',
            'Implantes odontologicos',
            'Kinesiologia',
            'Psicologia',
            'Medicamentos en farmacia',
            'Medicamentos en internacion',
            'Optica',
            'Cirugias esteticas',
            'Analisis clinicos',
            'Analisis de diagnostico',
        ];
        
        $porcentajes = $request->input('porcentaje');
            $request->validate(
                [
                    'porcentaje.*' => 'required|integer|min:0|max:100',
                ],
                [           
                    'porcentaje.*.required' => 'El porcentaje de la prestación no puede ser vacío.',
                    'porcentaje.*.integer' => 'El porcentaje de la prestación no tiene el formato adecuado.',
                    'porcentaje.*.min' => 'El porcentaje ingresado debe encontrarse entre 0 y 100.',
                    'porcentaje.*.max' => 'El porcentaje ingresado debe encontrarse entre 0 y 100.',
                ]
            );

            $planId = Plan::max('id');
            
            foreach ($enumValues as $index => $nombre_prestacion) {
                $cobertura = Cobertura::find($id);
                $cobertura->plan_id = $planId;
                $cobertura->nombre_prestacion = $nombre_prestacion;
                $cobertura->porcentaje = $porcentajes[$index];
                $cobertura->save();
                $cobertura->setHidden(['created_at', 'updated_at']);
            }

            return redirect()->to('/planes')->with('success', 'Coberturas modificadas correctamente');
    }
    /*public function update(Request $request, string $id)
{
    $porcentajes = $request->input('porcentaje');
    
    $request->validate([
        'porcentaje.*' => 'required|integer|min:0|max:100',
    ], [
        'porcentaje.*.required' => 'El porcentaje de la prestación no puede ser vacío.',
        'porcentaje.*.integer' => 'El porcentaje de la prestación no tiene el formato adecuado.',
        'porcentaje.*.min' => 'El porcentaje ingresado debe encontrarse entre 0 y 100.',
        'porcentaje.*.max' => 'El porcentaje ingresado debe encontrarse entre 0 y 100.',
    ]);

    foreach ($porcentajes as $coberturaId => $porcentaje) {
        $cobertura = Cobertura::find($coberturaId);
        $cobertura->porcentaje = $porcentaje;
        $cobertura->save();
    }

    return redirect()->to('/planes')->with('success', 'Coberturas modificadas correctamente');
}*/

    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
