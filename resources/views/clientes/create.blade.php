@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-8 offset-2">
    <h5 class="card-header">Crear clientes</h5>
        <div class="card-body rounded" style="border-radius: 20px;">
            @include('messages')
            <form action="/clientes" method="POST" enctype="multipart/form-data">
            @csrf
            @include('/clientes/dataForm')
        </form>
    </div>
    </div>    
</div>
@endsection