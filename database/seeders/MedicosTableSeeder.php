<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datosMedico = [
            'nombre' => 'El',
            'apellido' => 'Pepe',
            'matricula' => 'MP4834838',
            'dni' => 48723712,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('medicos')->insert($datosMedico);
    }
}
