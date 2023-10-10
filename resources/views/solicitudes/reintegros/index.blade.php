@extends('solicitudes/index')

@section('tipoDeSolicitud_content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="table-responsive">
        <table class="table" id="reintegros-table">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Apellido y Nombre</th>
                    <th>Fecha Solicitud</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($reintegros as $reintegroActual)
                    <tr class="reintegro-row" data-url="/solicitudes/reintegros/{{ $reintegroActual->id }}">
                        <td>{{ $reintegroActual->cliente->dni }}</td>
                        <td>{{ $reintegroActual->cliente->apellido }} {{ $reintegroActual->cliente->nombre }}</td>
                        <td>{{ $reintegroActual->fecha_solicitud }}</td>
                        <td>{{ $reintegroActual->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .reintegro-row {
            cursor: pointer;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var rows = document.querySelectorAll('.reintegro-row');

            rows.forEach(function (row) {
                row.addEventListener('click', function () {
                    var url = row.getAttribute('data-url');
                    window.location.href = url;
                });
            });
        });
    </script>
@endsection
