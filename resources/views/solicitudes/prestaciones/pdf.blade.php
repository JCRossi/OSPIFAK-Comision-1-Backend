<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Solicitud de Prestación</title>
    <style>
        /* Estilos CSS personalizados para el PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #78d278;
        }
        /* Agrega estilos CSS adicionales según tus necesidades */
    </style>
</head>
<body>
    <h2 class="text-center mt-3 mb-4">Solicitud de Prestación</h2>
    <p class="mb-0 text-start text-muted">Fecha solicitud: {{ \Carbon\Carbon::parse($prestacion->fecha_solicitud)->format('d/m/Y') }}</p>
    <p class="mb-0 text-start text-muted">Apellido y nombre: {{ $prestacion->cliente->apellido }}, {{ $prestacion->cliente->nombre }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DNI: {{ $prestacion->cliente->dni }}</p>
    <p class="mb-0 text-start text-muted">Profesional solicitante: {{ $prestacion->nombre_medico }}  - Matrícula: {{ $prestacion->matricula_medico }}</p>
    <p class="mb-0 text-start text-muted">Instituto: {{ $prestacion->instituto }}</p>
    <p class="mb-0 text-start text-muted">Fecha turno: {{ \Carbon\Carbon::parse($prestacion->fecha_turno)->format('d/m/Y') }}</p>

    <div class="d-flex justify-content-end mb-2">
        <a href="#" class="btn btn-outline-secondary text-muted" style="border: none;">
            <!-- Contenido del botón para descargar adjuntos -->
        </a>
    </div>

    <p align="left" class="mb-0 ml-2 text-muted">Observaciones empleado</p>
    <textarea class="form-control w-100" style="resize:none;-webkit-border-radius: 15px; -moz-border-radius: 15px; border-radius: 15px">{{ $prestacion->comentario }}</textarea>
</body>
</html>
