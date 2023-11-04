<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            'nombre' => 'Plan ORO',
            'estado' => 'Activo',
            'precio_jovenes' => 10.0,
            'precio_adultos_jovenes' => 15.0,
            'precio_adultos' => 20.0,
            'precio_adultos_mayores' => 25.0,
        ];
        DB::table('plans')->insert($datos);
    }
}
