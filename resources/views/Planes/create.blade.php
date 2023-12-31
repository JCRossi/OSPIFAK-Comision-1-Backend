@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-8 offset-2">
        <div class="card-body rounded" style="border-radius: 20px;">
            @include('messages')
            <form action="/planes" method="POST">
                @csrf
                @include('/planes/dataForm')
            </form> 
        </div>
    </div>    
</div>
@endsection