@extends('layouts/app')

@section('content')
<div class="container">
    <h5 class="text-center font-weight-bold text-success" style="font-size: 50px;">ALTA DE PLAN</h5>
    @include('messages')
    <form action="/planes" method="POST" enctype="multipart/form-data">
        @csrf
        @include('/planes/dataForm')
    </form>
</div>
@endsection