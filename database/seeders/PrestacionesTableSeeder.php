<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PrestacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datosPrestacion = [
            'cliente_id' => '1',
          //  'cliente_menor_id' => '1',
            'nombre_medico' => 'El Pepe',
            'matricula_medico' => 'MP4834838',
            'instituto' => 'Inova Diagnostico',
            'fecha_turno' => Carbon::now()->subDays(10),
            'fecha_solicitud' => now(),           
            'estado' => 'Pendiente',
            'nombre_prestacion' => 'Kinesiologia',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('prestaciones')->insert($datosPrestacion);

    }
}
