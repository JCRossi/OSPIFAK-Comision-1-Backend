@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-8 offset-2">
        <div class="card-body rounded" style="border-radius: 20px;">
            @include('messages')
            <form action="/planes/{{$plan->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="container">
                    @include('messages')
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label"style="font-size: 30px;">Nombre*</label>
                                <input type="text" name="nombre" value="{{$plan->nombre}}"   class="form-control @error('nombre') is-invalid @enderror bg-white" >
                                @error('nombre')
                                                <span class="tex-danger">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                @enderror
                            </div>

                            <label class="form-label"  style="font-size: 30px;" for="precio">Precios</label>

                            <div class="form-group mb-3">
                                <label class="form-label" for="precio_jovenes">Menores de 21 años*</label>
                                <input type="text" name="precio_jovenes" value="{{$plan->precio_jovenes}}" class="form-control @error('precio_jovenes') is-invalid @enderror bg-white" >
                                @error('precio_jovenes')
                                                <span class="tex-danger">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="precio_adultos_jovenes">De 21 a 35 años*</label>
                                <input type="text" name="precio_adultos_jovenes" value="{{$plan->precio_adultos_jovenes}}" class="form-control @error('precio_adultos_jovenes') is-invalid @enderror bg-white" >
                                @error('precio_adultos_jovenes')
                                                <span class="tex-danger">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="precio_adultos">de 35 a 55 años*</label>
                                <input type="text" name="precio_adultos" value="{{$plan->precio_adultos}}"  class="form-control @error('precio_adultos') is-invalid @enderror bg-white" >
                                @error('precio_adultos')
                                                <span class="tex-danger">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="precio_adultos_mayores">Mayores a 55 años*</label>
                                <input type="text" name="precio_adultos_mayores" value="{{$plan->precio_adultos_mayores}}" class="form-control @error('precio_adultos_mayores') is-invalid @enderror bg-white" >
                                @error('precio_adultos_mayores')
                                                <span class="tex-danger">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                            </div>

                            <div class="form-group float-end">
                                        <a href="/planes" class="btn btn-outline-primary">Cancelar</a>
                                        <a href="/Coberturas/edit/{{$plan->id}}" class="btn btn-outline-success">Editar Coberturas</a>

                            </div>
                    </div>

            </form> 
        </div>
    </div>    
</div>
@endsection