<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Prestacion;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Menor;
use Carbon\Carbon;




class ClientesControllerAPI extends Controller
{
     public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'usuario' => ['required','string'],
            'password' => ['required','string']
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()],401);
        }

       // if (!Auth::guard('clientes')->attempt($request->only(['usuario','password']))){
         //   return response()->json(['error' => 'Invalid usuario or password'],401);
       // }  

        $cliente = Cliente::where('usuario', $request->usuario)->first();
        $cliente->setHidden(['created_at', 'updated_at']);
        $token = $cliente->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'usuario' => $cliente,
            'token' => $token
        ],200);
    }
   


    public function registrar(Request $request)
    {
            $request->validate(
                [
                    'usuario' => 'required|string',
                    'password' => 'required|string',
                    'nombre' => 'required|string|max:50',
                    'apellido' => 'required|string|max:50',
                    'fecha_nacimiento' => 'required|date',
                    'dni' => 'required|numeric|min:1|max:99999999|unique:clientes,dni',
                    'email' => 'required|email',
                    'direccion' => 'required|string|max:100',
                    'telefono' => 'required|numeric|max:9999999999',
                ],
                [
                    'usuario.required' => 'El usuario no puede ser vacío',
                    'usuario.string' => 'El usuario no tiene el formato adecuado.',
    
                    'password.required' => 'El password no puede ser vacío.',
                    'password.string' => 'El password no tiene el formato adecuado.',

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
                    'dni.unique' => 'Ya existe un cliente registrado con el DNI ingresado.',

                    'email.required' => 'El email no puede ser vacío.',
                    'email.email' => 'El email no tiene el formato adecuado.',

                    'direccion.required' => 'La direccion no puede ser vacía',
                    'direccion.string' => 'La direccion no tiene el formato adecuado.',
                    'direccion.max' => 'La direccion ingresada es más extenso de lo permitido (50 caracteres).',

                    'telefono.required' => 'El telefono no puede ser vacío',
                    'telefono.numeric' => 'El telefono no tiene el formato adecuado.', 
                    'telefono.max' => 'El telefono debe tener 10 digitos como maximo',

                 ]
            );

            $cliente = DB::table('clientes')->where('dni', $request -> dni)->first();
            if ($cliente) {
                return response()->json(['error' => 'El cliente con DNI ' . $request -> dni . ' ya existe.'], 404);
            }

             // Verificar la edad del titular
             $fechaNacimientoTitular = $request->input('fecha_nacimiento');
             $hoy = now();
             $edadTitular = $hoy->diffInYears($fechaNacimientoTitular);
 
             if ($edadTitular < 18) {
                 return back()->withErrors(['fecha_nacimiento' => 'El titular debe ser mayor de 18 años']);
             }

            $cliente = new Cliente();
            $cliente -> usuario = $request -> get('usuario'); 
            $cliente -> password = $request -> get('password'); 
            $cliente -> nombre = $request -> get('nombre'); 
            $cliente -> apellido = $request -> get('apellido'); 
            $cliente -> fecha_nacimiento = $request -> get('fecha_nacimiento'); 
            $cliente -> dni = $request -> get('dni'); 
            $cliente -> email = $request -> get('email'); 
            $cliente -> direccion = $request -> get('direccion'); 
            $cliente -> telefono = $request -> get('telefono'); 
            $cliente -> plan_id = $request -> get('plan_id');
            $cliente -> forma_pago = $request -> get('forma_pago'); 
            $cliente->save();
            $cliente->setHidden(['created_at', 'updated_at']);

            // Verificar la edad de los menores a cargo
            if ($request->has('menores')) {
                foreach ($request->input('menores') as $menorData) {
                    $fechaNacimientoMenor = $menorData['fecha_nacimiento'];
                    $edadMenor = $hoy->diffInYears($fechaNacimientoMenor);
                    if ($edadMenor >= 18) {
                        return back()->withErrors(['menores' => 'Los menores a cargo deben ser menores de 18 años']);
                    }
                }
            }
            
            return response()->json(['message' => 'El cliente fue creado con éxito'], 201);
    }

    public function datos(Request $request)
    {
        $usuario = $request->usuario;
        // Buscar el cliente por usuario
        $cliente = Cliente::where('usuario', $usuario)->first();

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        // Obtener la información del cliente
        $clienteInfo = [
            'DNI' => $cliente->dni,
            'nombre' => $cliente->nombre,
            'apellido' => $cliente->apellido,
            'fecha_nacimiento' => $cliente->fecha_nacimiento,
            'email' => $cliente->email,
            'direccion' => $cliente->direccion,
            'telefono' => $cliente->telefono,
        ];

        // Verificar si existen clientes menores asociados
        $clientesMenores = Menor::where('cliente_id', $cliente->id)->get();

        if ($clientesMenores->count() > 0) {
            // Agregar información de los clientes menores al resultado
            $clienteInfo['clientes_menores'] = $clientesMenores;
        }

        return response()->json($clienteInfo);
    }  

/*
    public function registrarMenor(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|string|max:50',
                'apellido' => 'required|string|max:50',
                'fecha_nacimiento' => 'required|date',
                'dni' => 'required|numeric|min:1|max:99999999|unique:cliente_menor,dni',
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
                'dni.unique' => 'Ya existe un menor registrado con el email ingresado.',

            ]
        );

        $clienteId = Cliente::max('id');

        $menor = new Menor();

        $menor->cliente_id = $clienteId;
        $menor->nombre = $request -> get('nombre'); 
        $menor->apellido = $request -> get('apellido'); 
        $menor->fecha_nacimiento = $request -> get('fecha_nacimiento'); 
        $menor->dni = $request -> get('dni');

        $menor->save();
        $menor->setHidden(['created_at', 'updated_at']);
    
        return response()->json(['message' => 'El menor fue creado con éxito'], 201);
    }
*/
    public function recuperarPrestaciones(Request $request){
        $data = $request->json()->all();
        $dniCliente = $data['dni'];
    
        $cliente = Cliente::where('dni', $dniCliente)->first();
    
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }
    
        $prestaciones = Prestacion::select('prestaciones.estado', 'prestaciones.fecha_solicitud', 
        DB::raw('(SELECT dni FROM clientes WHERE prestaciones.cliente_id = clientes.id) as cliente_dni'),
        DB::raw('(SELECT nombre FROM clientes WHERE prestaciones.cliente_id = clientes.id) as cliente_nombre'),
        DB::raw('(SELECT apellido FROM clientes WHERE prestaciones.cliente_id = clientes.id) as cliente_apellido'),
        DB::raw('(SELECT dni FROM cliente_menor WHERE prestaciones.cliente_menor_id = cliente_menor.id) as cliente_menor_dni'),
        DB::raw('(SELECT nombre FROM cliente_menor WHERE prestaciones.cliente_menor_id = cliente_menor.id) as cliente_menor_nombre'),
        DB::raw('(SELECT apellido FROM cliente_menor WHERE prestaciones.cliente_menor_id = cliente_menor.id) as cliente_menor_apellido'))
        ->where(function ($query) use ($dniCliente) {
            $query->whereHas('cliente', function ($query) use ($dniCliente) {
                $query->where('dni', $dniCliente);
            });
        })
        ->get();





        /*
        $items = Item::select('item.id', 'nombre', 'etiqueta', 'precio', 'item.activo', 'path_imagen')
                    ->leftJoin('tipo', function ($join) {
                        $join->on('item.tipo_id', '=', 'tipo.id');
                    })
                    ->where('item.activo', 1)
                    ->where('tipo.activo', 1)
                    ->orderBy('item.id')
                    ->paginate(10);
        
        $prestaciones = Prestacion::where('cliente_id', $cliente->id)->get();*/

        return response()->json($prestaciones);
    }
    
    public function recuperarMenores(Request $request){
        $data = $request->json()->all();
        $dniCliente = $data['dni'];
    
        $cliente = Cliente::where('dni', $dniCliente)->first();
    
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }
    
        $menores = Menor::where('cliente_id', $cliente->id)->get();
        return response()->json($menores);
    }

   // public function getTitularYMenoresACargo(string $usuario){
    public function recuperarPlan(Request $request){
        $data = $request->json()->all();
        $dniCliente = $data['dni'];
    
        $cliente = Cliente::where('dni', $dniCliente)->first();
    
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }
    
        $plan = Plan::where('id', $cliente->plan_id)->first();
        return response()->json($plan);
    }
    
    public function guardarPrestacion(Request $request)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(),[
            'dni' => 'required',
            'profesional' => 'required|string',
            'matricula' => 'required|numeric',
            'tipoPrestacion' => 'required',
            'instituto' => 'required|string',
            'fechaTurno' => 'required|date',
            'comentarios' => 'nullable',
        ],
        [
            'fechaTurno.required' => 'La fecha del turno no puede ser vacía.',
            'fechaTurno.date' => 'La fecha del turno no tiene el formato adecuado.',

            'dni.required' => 'Debe estar logueado para solicitar una prestación.',

            'profesional.required' => 'Debe ingresar el nombre de un médico',
            'profesional.string' => 'El médico no tiene el formato adecuado.',

            'instituto.required' => 'Debe ingresar el nombre de un médico',
            'instituto.string' => 'El instituto no tiene el formato adecuado.',

            'matricula.required' => 'La matricula no puede ser vacía',
            'matricula.numeric' => 'La matricula no tiene el formato adecuado.', 

            'tipoPrestacion.required' => 'Debe seleccionar el tipo de la prestacion',

         ]);
        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()],401);
        }
    
        // Buscar el cliente en función del DNI proporcionado
        $cliente = Cliente::where('dni', $request->input('dni'))->first();
    
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

    
        // Obtener el ID del cliente y del menor (si se seleccionó uno)
        $clienteId = $cliente->id;
        $clienteMenorId = null;
    
        if ($request->input('selectedClienteDNI') !== $request->input('dni')) {
            // Si el cliente seleccionado es distinto del cliente principal, se usa el DNI del cliente seleccionado como cliente_menor_id
            $clienteMenor = Menor::where('dni', $request->input('selectedClienteDNI'))->first();
    
            if ($clienteMenor) {
                $clienteMenorId = $clienteMenor->id;
            }
        }
        $fechaSolicitud = Carbon::now();
        $estado = 'Pendiente';
        // Crear una nueva instancia de Prestacion
        $prestacion = new Prestacion();
        $prestacion->cliente_id = $clienteId;
        $prestacion->cliente_menor_id = $clienteMenorId;
        $prestacion->nombre_medico = $request->input('profesional');
        $prestacion->matricula_medico = $request->input('matricula');
        $prestacion->instituto = $request->input('instituto');
        $prestacion->fecha_turno = $request->input('fechaTurno');
        $prestacion->estado = $estado; // Estado inicial
        $prestacion->nombre_prestacion = $request->input('tipoPrestacion');
        $prestacion->comentario = $request->input('comentarios');
        $prestacion->fecha_solicitud = $fechaSolicitud;
    
        // Guardar la prestación en la base de datos
        $prestacion->save();
    
        // Puedes realizar acciones adicionales después de guardar la prestación
    
        return response()->json(['message' => 'Prestación guardada con éxito'], 201);
    }

    public function getTitularYMenoresACargo(string $usuario){
        $cliente = Cliente::where('usuario', $usuario)->first();

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 405);
        }

        $menores = Menor::where('cliente_id', $cliente->id)->where('estado', 'Activo')->get();

        $titularYMenoresACargo = [
            'cliente' => $cliente,
            'menores' => $menores,
        ];
    
        return response()->json($titularYMenoresACargo);
    }

     /**
     * Soft delete the specified resource.
     */
    /*
    public function delete(string $usuario)
    {
        $cliente = Cliente::where('usuario', $usuario)->first();

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 405);
        }

        $menores = Menor::where('cliente_id', $cliente->id)->where('estado', 'Activo')->get();

        $titularYMenoresACargo = [
            'cliente' => $cliente,
            'menores' => $menores,
        ];
    
        return response()->json($titularYMenoresACargo);
    }
*/
     /**
     * Soft delete the specified resource.
     */
    /*
    public function delete(Request $request)
    {
        $clienteUsuario = $request->get('cliente_usuario');
        $cliente = Cliente::where('usuario', $clienteUsuario)->first();
        if (!$cliente){
            $cliente = Menor::where('nombre', $clienteUsuario)->first();
            if (!$cliente){
                return response()->json(['error' => 'Cliente no encontrado'], 404);
            }
        }
        else {
            $menores = Menor::where('cliente_id', $cliente->id)->get();

            foreach ($menores as $menor) {
                $menor->estado = 'Inactivo';
                $menor->save();
            }
        }

        $cliente->estado = 'Inactivo';
        $cliente->save();

        return response()->json(['message' => 'Baja solicitada con éxito'], 200);
    }

*/

    public function registrarMenor(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|string|max:50',
                'apellido' => 'required|string|max:50',
                'fecha_nacimiento' => 'required|date',
                'dni' => 'required|numeric|min:1|max:99999999|unique:cliente_menor,dni',
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
                'dni.unique' => 'Ya existe un menor registrado con el email ingresado.',

            ]
        );

        $clienteId = Cliente::max('id');

        $fechaNacimientoMenor = $request->input('fecha_nacimiento');
        $hoy = now();
        $edadMenor = $hoy->diffInYears($fechaNacimientoMenor);

        if ($edadMenor >= 18) {
            return back()->withErrors(['fecha_nacimiento' => 'El menor a cargo debe ser menor de 18 años']);
        }

        $menor = new Menor();

        $menor->cliente_id = $clienteId;
        $menor->nombre = $request -> get('nombre'); 
        $menor->apellido = $request -> get('apellido'); 
        $menor->fecha_nacimiento = $request -> get('fecha_nacimiento'); 
        $menor->dni = $request -> get('dni');

        $menor->save();
        $menor->setHidden(['created_at', 'updated_at']);
    
        return response()->json(['message' => 'El menor fue creado con éxito'], 201);
    }

}
