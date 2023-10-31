<!DOCTYPE html>
<html>
<head>
    <title>OSPIFAK - Cupon de Pago</title>
    <style>
        .container {
            margin: 0 auto;
            width: 80%;
            text-align: center;
        }
        .card {
            margin-top: 20px;
            border-radius: 20px;
        }
        h1 {
            text-align: center;
            color: #78d278;
        }
        h3 {
            font-size: 20px;
            color: #78d278;
        }
        table {
            width: 100%;
            margin-top: 1rem;
            border: 1px solid #78d278;
        }
        .input-group {
            margin-bottom: 1rem;
        }
        .input-group-text {
            background-color: white;
        }
        .form-control {
            font-size: x-large;
        }
        img {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card col-8 offset-2">
            <div class="card-body rounded">
                <h1>Cupón de Pago</h1>
                <h3>Titular:</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>DNI: {{ $cliente->dni }}</td>
                            <td>Apellido y nombre: {{ $cliente->apellido }} {{ $cliente->nombre }}</td>
                            <td>
                                @php
                                    $edad = $edad; // Utiliza la variable $edad pasada desde el controlador
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
                <div class="input-group">
                    <h3>Menores a cargo:</h3>
                </div>
                @if(count($menores) > 0)
                    <table class="table table-bordered">
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
                <br>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text">Plan:</span>
                            <span class="input-group-text" style="font-weight: bold;">{{ $cliente->plan_nombre }}</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Forma de Pago:</span>
                            <span class="input-group-text" style="font-weight: bold;">{{ $cliente->forma_pago }}</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Período de Pago:</span>
                            <span class="input-group-text" style="font-weight: bold;">{{ $periodo_pago }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text" style="font-size: 24px;">Precio total:</span>
                            <span class="input-group-text" style="font-weight: bold; font-size: 24px;">
                                @php
                                    $precioCliente = $cliente->precio_adultos_jovenes;
                                    if ($edad >= 21 && $edad <= 35) {
                                        $precioCliente = $cliente->precio_adultos_jovenes;
                                    } elseif ($edad >= 36 && $edad <= 55) {
                                        $precioCliente = $cliente->precio_adultos;
                                    } elseif ($edad >= 56) {
                                        $precioCliente = $cliente->precio_adultos_mayores;
                                    } else {
                                        $precioCliente = $cliente->precio_jovenes;
                                    }
                                    $precioTotal = ($precioCliente + count($menores) * $cliente->precio_jovenes) * $factorMultiplicacion; // Multiplica por el factor de multiplicación
                                    echo '$' . $precioTotal;
                                @endphp
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
