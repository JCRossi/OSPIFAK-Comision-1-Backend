@php
    use App\Models\Empleado;
@endphp

@section('content')
    <h2 class="text-center mt-3 mb-4" style="color: #78d278;">Definición de Coberturas</h2>
    <div class="container">
        @include('messages')

        <form action="/coberturas" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Prestación</th>
                        <th>Porcentaje</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($enumValues as $index => $prestacion)
                        <tr>
                            <td>{{ $prestacion }}</td>
                            <td>
                                <input type="number" name="porcentaje[{{ $index }}]" class="form-control" value="{{ old('porcentaje.' . $index) }}">
                                @error('porcentaje.' . $index)
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="form-group float-end">
                <a href="/planes/create" class="btn btn-outline-primary">Cancelar</a>
                <button type="submit" class="btn btn-outline-success">Guardar Datos</button>
            </div>
        </form>
    </div>
@endsection