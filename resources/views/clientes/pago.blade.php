@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-8 offset-2">
        <div class="card-body rounded" style="border-radius: 20px;">
            <div class="input-group mb-3 ">
                <label class="form-label text" style="font-size: x-large; color: #78d278;">Titular</label>
            </div>

            @php
            function calcularEdad($fechaNacimiento) {
                $fechaActual = date('Y-m-d');
                $edad = date_diff(date_create($fechaNacimiento), date_create($fechaActual));
                return $edad->y;
            }
            @endphp

            <table class="table table-striped mt-4">
                <tbody>
                    <tr>
                        <td>DNI: {{ $cliente->dni }}</td>
                        <td>Apellido y nombre: {{ $cliente->apellido }} {{ $cliente->nombre }}</td>
                        <td>
                            @php
                            $edad = calcularEdad($cliente->fecha_nacimiento);
                            if ($edad >= 21 && $edad <= 35) {
                                echo 'Precio por mes: $' . $cliente->precio_adultos_jovenes;
                            } elseif ($edad >= 36 && $edad <= 55) {
                                echo 'Precio por mes: $' . $cliente->precio_adultos;
                            } elseif ($edad >= 56) {
                                echo 'Precio por mes: $' . $cliente->precio_adultos_mayores;
                            } else {
                                echo 'Precio por mes: $' . $cliente->precio_jovenes;
                            }
                            @endphp
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="input-group mb-3 ">
                <label class="form-label text" style="font-size: x-large; color: #78d278;">Menores a cargo</label>
            </div>

            @if(count($menores) > 0)
            <table class="table table-striped mt-4">
                <tbody>
                    @foreach($menores as $menor)
                    <tr>
                        <td>{{ $menor->dni }}</td>
                        <td>{{ $menor->apellido }} {{ $menor->nombre }}</td>
                        <td>Precio por mes: ${{$cliente->precio_jovenes}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No hay menores asociados a este cliente.</p>
            @endif

            <div class="row">
                <div class="col-md-6">

                    <form method="get" action="{{ route('pdf', ['id' => $cliente->id]) }}">
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: white;">Forma de Pago:</span>
                            <span class="input-group-text" style="font-size: x-large; background-color: white;">{{$cliente->forma_pago}}</span>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text" for="periodo_pago">Período de Pago:</label>
                            <select class="form-select" id="periodo_pago" name="periodo_pago">
                                @if ($cliente->forma_pago === 'Mensual')
                                <option value="noviembre 2023">Noviembre 2023</option>
                                <option value="diciembre 2023">Diciembre 2023</option>
                                <option value="enero 2024">Enero 2024</option>
                                <!-- Agrega más meses según sea necesario -->
                                @elseif ($cliente->forma_pago === 'Semestral')
                                <option value="segundo semestre 2023">2do Semestre 2023</option>
                                <option value="primer semestre 2024">1er Semestre 2024</option>
                                <option value="segundo semestre 2024">2do Semestre 2024</option>
                                <!-- Agrega más opciones de semestre según sea necesario -->
                                @elseif ($cliente->forma_pago === 'Anual')
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <!-- Agrega más años según sea necesario -->
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-success">Generar y descargar PDF</button>
                    </form>
                </div>

                @php
                $factorMultiplicacion = 1; // Valor predeterminado (mensual)

                // Verifica la forma de pago y establece el factor de multiplicación
                if ($cliente->forma_pago === 'Semestral') {
                    $factorMultiplicacion = 6;
                } elseif ($cliente->forma_pago === 'Anual') {
                    $factorMultiplicacion = 12;
                }
                @endphp

                <div class="col-md-6 col-md-offset-15">
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="background-color: white;">Plan:</span>
                        <span class="input-group-text" style="font-size: x-large; background-color: white;">{{$cliente->plan_nombre}}</span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="background-color: white;">Precio total:</span>
                        <span class="input-group-text" style="font-size: x-large; background-color: white;">
                            @php
                            $edad = calcularEdad($cliente->fecha_nacimiento);
                            if ($edad >= 21 && $edad <= 35) {
                                $precioCliente = $cliente->precio_adultos_jovenes;
                            } elseif ($edad >= 36 && $edad <= 55) {
                                $precioCliente = $cliente->precio_adultos;
                            } elseif ($edad >= 56) {
                                $precioCliente = $cliente->precio_adultos_mayores;
                            } else {
                                $precioCliente = $cliente->precio_jovenes;
                            }
                            $precioTotal = ($precioCliente + count($menores) * $cliente->precio_jovenes) * $factorMultiplicacion;
                            echo '$' . $precioTotal;
                            @endphp
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
