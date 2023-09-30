@extends('layouts/app')

@section('content')
<div class="container">
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session()->has('showLoggedInMessage') && session('showLoggedInMessage'))
                        <div class="alert alert-success">
                            You're logged in!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <a href="/empleados" class="btn btn-light">Empleados</a>
    <a href="/categorias" class="btn btn-light">Categorias</a>
</div>

@endsection