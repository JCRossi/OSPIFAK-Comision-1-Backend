@php
    use App\Models\Prestacion;
@endphp

@extends('dashboard')

@section('section_content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-center mt-3 mb-4" style="color: #78d278;">Solicitud de prestacion</h2>
    <div class="container">
        <div class="row">
           <div class="col-md-6">
            <p class="mb-0 text-start text-muted">Fecha solicitud: {{ \Carbon\Carbon::parse($prestacion->fecha_solicitud)->format('d/m/Y') }}</p>
            
            <p class="mb-0 text-start text-muted">Apellido y nombre: {{ $prestacion->cliente->apellido }}, {{ $prestacion->cliente->nombre }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DNI: {{ $prestacion->cliente->dni }}</p>

            <p class="mb-0 text-start text-muted">Profesional solicitante: {{ $prestacion->nombre_medico }}  - Matrícula: {{ $prestacion->matricula_medico }}</p>

            <p class="mb-0 text-start text-muted">Instituto: {{ $prestacion->instituto }}</p>

            <p class="mb-0 text-start text-muted">Fecha turno: {{ \Carbon\Carbon::parse($prestacion->fecha_turno)->format('d/m/Y') }}</p>
            </div>
        </div>


        <div class="d-flex justify-content-end mb-2">
            <a href="#" class="btn btn-outline-secondary text-muted" style="border: none;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; margin-right: 1rem;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                </svg>
                  
                Descargar adjuntos
            </a>
        </div>

        <p align="left" class="mb-0 ml-2 text-muted">Observaciones empleado</p>
        <textarea class="form-control w-100" style="resize:none;-webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        border-radius: 15px">{{ $prestacion->comentario }}</textarea>

        <div class="form-group mt-3 float-end mt-3">
            <a href="{{ url('/solicitudes/prestaciones') }}" class="btn btn-outline-info">Cancelar</a>
            
            <form action="{{ route('prestaciones/update', ['id' => $prestacion->id, 'estado' => 'Aprobada']) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-success">Aprobar</button>
                <a href="{{ route('prestaciones/pdf', ['id' => $prestacion->id]) }}">Aprobar</a>

            </form>

            <form action="{{ route('prestaciones/update', ['id' => $prestacion->id, 'estado' => 'Rechazada']) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-danger">Rechazar</button>
            </form>
        </div>
    </div>
@endsection



