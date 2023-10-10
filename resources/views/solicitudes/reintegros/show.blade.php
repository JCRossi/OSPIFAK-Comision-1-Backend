@php
    use App\Models\Reintegro;
@endphp

@extends('solicitudes/index')

@section('tipoDeSolicitud_content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-center mt-3 mb-4" style="color: #78d278;">Solicitud de reintegro</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="fw-bold">Fecha solicitud:</p>
                <p>{{ $reintegro->created_at }}</p>

                <p class="fw-bold">Apellido y nombre:</p>
                <p>{{ $reintegro->cliente->apellido }}, {{ $reintegro->cliente->nombre }}</p>

                <p class="fw-bold">DNI:</p>
                <p>{{ $reintegro->cliente->dni }}</p>

                <p class="fw-bold">Profesional solicitante:</p>
                <p>{{ $reintegro->nombre_profesional }}</p>

                <p class="fw-bold">Matricula:</p>
                <p>{{ $reintegro->matricula_profesional }}</p>

                <p class="fw-bold">Instituto:</p>
                <p>{{ $reintegro->instituto }}</p>

                <p class="fw-bold">Fecha estudio/compra:</p>
                <p>{{ $reintegro->fecha_estudio_compra }}</p>
            </div>

            <div class="col-md-6">
                <div class="d-flex justify-content-end mb-2">
                    <a href="#" class="btn btn-outline-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Descargar adjuntos
                    </a>
                </div>

                <p class="fw-bold">Observaciones empleado:</p>
                <textarea class="form-control" rows="5" readonly>{{ $reintegro->observaciones_empleado }}</textarea>

                <div class="form-group mt-3 float-end">
                    <form action="/solicitudes/reintegros" method="POST" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="{{ $reintegro->id }}">
                        <input type="hidden" name="estado" value="aprobado">
                        <button type="submit" class="btn btn-outline-success">Aprobar</button>
                    </form>

                    <form action="/solicitudes/reintegros" method="POST" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="{{ $reintegro->id }}">
                        <input type="hidden" name="estado" value="rechazado">
                        <button type="submit" class="btn btn-outline-danger">Rechazar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
