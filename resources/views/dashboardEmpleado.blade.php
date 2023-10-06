@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Bienvenido a OSPIFAK') }}
            </h2>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        @if(session()->has('showLoggedInMessage') && session('showLoggedInMessage'))
                            <div class="alert alert-success">
                                You're logged in!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="navbar">
            <div class="container text-center">
                <ul class="nav">
                    <li class="{{ Request::is('clientes*') ? 'active' : '' }}">
                        <a href="{{ url('/clientes') }}">Gestión de clientes</a>
                    </li>                    
                    <li class="{{ Request::is('solicitudes*') ? 'active' : '' }}">
                        <a href="{{ url('/solicitudes') }}">Gestión de solicitudes</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container text-center">
            @yield('section_content')
        </div>
    </div>
@endsection