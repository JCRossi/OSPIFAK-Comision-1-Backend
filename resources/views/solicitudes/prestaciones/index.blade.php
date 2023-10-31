

@extends('solicitudes/index')

@section('tipoDeSolicitud_content')
    <div class="d-flex justify-content-end mb-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" style="width: 2rem; height: 2rem; margin-right: 1rem; cursor: pointer;" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="filter-icon" data-bs-toggle="modal" data-bs-target="#filterModal">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
        </svg>
    </div>

    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-5">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Columna izquierda -->
                            <form id="filterForm">
                                <div class="mb-3">
                                    <label for="dniInput" class="form-label">DNI</label>
                                    <input type="text" class="form-control" id="dniInput">
                                </div>
                                <div class="mb-3">
                                    <label for="desdeInput" class="form-label">Desde</label>
                                    <input type="date" class="form-control" id="desdeInput" value="">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <!-- Columna derecha -->
                            <form>
                                <div class="mb-3">
                                    <label for="estadoSelect" class="form-label">Estado</label>
                                    <select class="form-select" id="estadoSelect">
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Aprobada">Aprobada</option>
                                        <option value="Rechazada">Rechazada</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="hastaInput" class="form-label">Hasta</label>
                                    <input type="date" class="form-control" id="hastaInput" value="">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table" id="prestaciones-table">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Apellido y Nombre</th>
                    <th>Fecha Solicitud</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prestaciones as $prestacionActual)
                <tr class="prestacion-row" data-url="/solicitudes/prestaciones/{{ $prestacionActual->id }}">
                    <td>{{ $prestacionActual->prestacionesPropias->dni }}</td>
                    <td>{{ $prestacionActual->prestacionesPropias->apellido }} {{ $prestacionActual->prestacionesPropias->nombre }}</td>
                    <td>{{ $prestacionActual->fecha_turno }}</td>
                    <td>{{ $prestacionActual->estado }}</td>
                </tr>
                @empty
                <!-- Mostrar mensaje cuando no hay filas -->
                <tr>
                    <td colspan="4" class="text-center">
                        No existen prestaciones para los filtros ingresados, corríjalos o 
                        <a href="/solicitudes/prestaciones">toque aquí</a> para limpiar los filtros.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <style>
        .prestacion-row {
            cursor: pointer;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var rows = document.querySelectorAll('.prestacion-row');
    
            var dniInput = document.getElementById('dniInput');
            var desdeInput = document.getElementById('desdeInput');
            var estadoSelect = document.getElementById('estadoSelect');
            var hastaInput = document.getElementById('hastaInput');
    
            // Inicializar variables
            var dniFilter = '';
            var hoy = new Date(); // Fecha actual
            var unAnoAtras = new Date();
            unAnoAtras.setFullYear(hoy.getFullYear() - 1);
            var desdeFilter = unAnoAtras.toISOString().split('T')[0]; // Fecha actual menos un año en formato yyyy-mm-dd
            var estadoFilter = 'Pendiente';
            var hastaFilter = hoy.toISOString().split('T')[0]; // Fecha actual en formato yyyy-mm-dd
    
            // Manejar cambios en los campos del formulario
            dniInput.addEventListener('input', function () {
                dniFilter = dniInput.value;
            });
    
            desdeInput.addEventListener('input', function () {
                desdeFilter = desdeInput.value;
            });
    
            estadoSelect.addEventListener('change', function () {
                estadoFilter = estadoSelect.value;
            });
    
            hastaInput.addEventListener('input', function () {
                hastaFilter = hastaInput.value;
            });
    
            rows.forEach(function (row) {
                row.addEventListener('click', function () {
                    var url = row.getAttribute('data-url');
                    window.location.href = url;
                });
            });
    
            $('#filterModal').on('show.bs.modal', function () {
                // Al abrir el modal, actualiza los valores de los campos con las variables
                dniInput.value = dniFilter;
                desdeInput.value = desdeFilter;
                estadoSelect.value = estadoFilter;
                hastaInput.value = hastaFilter;
            });

            $('#filterModal').on('hidden.bs.modal', function () {
                // Aquí puedes realizar acciones después de cerrar el modal
                // Por ejemplo, puedes llamar a una función para cargar los reintegros con los filtros aplicados
                window.location.href = '/solicitudes/prestaciones?dni=' + dniFilter + '&desde=' + desdeFilter + '&estado=' + estadoFilter + '&hasta=' + hastaFilter;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
@endsection
