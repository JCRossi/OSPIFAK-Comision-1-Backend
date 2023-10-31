<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanesControllerAPI extends Controller
{
    public function index()
    {
        $planes = Plan::all();
        return response()->json($planes);
    }
}
