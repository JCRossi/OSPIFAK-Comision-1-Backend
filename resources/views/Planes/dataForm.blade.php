@php
    use App\Models\Empleado;
@endphp

<h2 class="text-center mt-3 mb-4" style="color: #78d278;">Alta Plan</h2>
<div class="container">
    @include('messages')
        <form action="/planes" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label"style="font-size: 30px;">Nombre</label>
                <input type="text" name="nombre"  class="form-control @error('nombre') is-invalid @enderror bg-white" >
                @error('nombre')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
            </div>

            <label class="form-label"  style="font-size: 30px;" for="precio">Precios</label>

            <div class="form-group mb-3">
                <label class="form-label" for="precio_jovenes">Menores de 21 años</label>
                <input type="text" name="precio_jovenes" class="form-control @error('precio_jovenes') is-invalid @enderror bg-white" >
                @error('precio_jovenes')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="precio_adultos_jovenes">De 21 a 35 años</label>
                <input type="text" name="precio_adultos_jovenes" class="form-control @error('precio_adultos_jovenes') is-invalid @enderror bg-white" >
                @error('precio_adultos_jovenes')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="precio_adultos">de 35 a 55 años</label>
                <input type="text" name="precio_adultos" class="form-control @error('precio_adultos') is-invalid @enderror bg-white" >
                @error('precio_adultos')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="precio_adultos_mayores">Mayores a 55 años</label>
                <input type="text" name="precio_adultos_mayores" class="form-control @error('precio_adultos_mayores') is-invalid @enderror bg-white" >
                @error('precio_adultos_mayores')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="descripcion"style="font-size: 30px;">Coberturas</label>
                <br>
                <a href="{{ url('/coberturas/create') }}" class="btn btn-outline-warning">Coberturas</a>
            </div>



            <div class="form-group float-end">
                        <a href="/planes" class="btn btn-outline-primary">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success">Guardar datos</button>
            </div>
    </form>
</div>