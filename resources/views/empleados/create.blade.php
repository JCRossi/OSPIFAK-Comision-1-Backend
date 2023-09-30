@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-6 offset-3">
    <h5 class="card-header">Nuevo empleado</h5>
    <div class="card-body">
    @include('messages')
        <form action="/empleados" method="POST">
            @csrf
            @include('/empleados/dataForm')
        </form>
    </div>
    </div>    
</div>
@endsection