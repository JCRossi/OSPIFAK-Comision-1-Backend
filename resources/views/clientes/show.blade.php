@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-8 offset-2">
        <div class="card-body rounded" style="border-radius: 20px;">
            <div class="input-group mb-3 ">
                <label class="form-label text" style="font-size: x-large; color: #78d278;">Titular</label>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" style= "font-size: x-large; background-color: white;">DNI:</span>
                        <span class="input-group-text" style= "font-size: x-large; background-color: white;">{{$cliente->dni}}</span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" style= "background-color: white;">Apellido y nombre:</span>
                        <span class="input-group-text" style= "font-size: x-large; background-color: white;">{{$cliente->apellido}} {{$cliente->nombre}}</span>
                    </div>
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text" style= "background-color: white;">Fecha de Nacimiento:</span>
                        <span class="input-group-text" style= "font-size: x-large; background-color: white;">{{$cliente->fecha_nacimiento}}</span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" style= "background-color: white;">Plan:</span>
                        <span class="input-group-text" style= "font-size: x-large; background-color: white;">{{$cliente->plan_nombre}}</span>
                    </div>
                    
                </div>
                
                <div class="col-md-6 col-md-offset-15">

                    <div class="input-group mb-3">
                        <span class="input-group-text" style= "background-color: white;">Email:</span>
                        <span class="input-group-text" style= "font-size: x-large; background-color: white;">{{$cliente->email}}</span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" style= "background-color: white;">Dirección:</span>
                        <span class="input-group-text" style= "font-size: x-large; background-color: white;">{{$cliente->direccion}}</span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" style= "background-color: white;">Teléfono:</span>
                        <span class="input-group-text" style= "font-size: x-large; background-color: white;">{{$cliente->telefono}}</span>
                    </div>
    
                    <div class="input-group mb-3">
                        <span class="input-group-text" style= "background-color: white;">Forma de Pago:</span>
                        <span class="input-group-text" style= "font-size: x-large; background-color: white;">{{$cliente->forma_pago}}</span>
                    </div>
                </div>
            </div>
            
            <div class="input-group mb-3 ">
                <label class="form-label text" style="font-size: x-large; color: #78d278;">Menores a cargo</label>
            </div>

            @php
            function calcularEdad($fechaNacimiento) {
                $fechaActual = date('Y-m-d');
                $edad = date_diff(date_create($fechaNacimiento), date_create($fechaActual));
                return $edad->y;
            }
            @endphp

            @if(count($menores) > 0)
                <table class="table table-striped mt-4">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">DNI</th>
                            <th scope="col">Apellido y nombre</th>
                            <th scope="col">Edad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menores as $menor)
                        <tr>
                            <td>{{ $menor->dni }}</td>
                            <td>{{ $menor->apellido }} {{ $menor->nombre }}</td>
                            <td>{{ calcularEdad($menor->fecha_nacimiento) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay menores asociados a este cliente.</p>
            @endif
            <div class="form-group">
                <a href="{{ route('pago', ['id' => $cliente->id]) }}" class="btn btn-outline-success">Generar cupón de pago</a>
            </div>

            <div class="form-group float-end">
            <a href="/clientes" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            </div>
        </div>
    </div>    
</div>
@endsection