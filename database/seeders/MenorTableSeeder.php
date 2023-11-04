<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.$table->id();
     */
    public function run(): void
    {
        $datosMenor = [
            'nombre' => 'pequeno',
            'apellido' => 'elpepecito',
            'fecha_nacimiento' => '2010-01-01',
            'dni' => 87654673,
            'cliente_id' => 1,
            'estado' => 'Activo',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('cliente_menor')->insert($datosMenor);
    }
}