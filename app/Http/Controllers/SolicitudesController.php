<?php

namespace App\Http\Controllers;

class SolicitudesController extends Controller
{
    public function index()
    {
        return view('solicitudes/index');
    }
}