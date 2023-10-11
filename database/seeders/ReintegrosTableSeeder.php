<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReintegrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datosReintegro = [
            'cliente_id' => '1',
            'medico_id' => '1',
            'nombre_instituto' => 'Inova Diagnostico',
            'fecha_estudio_compra' => Carbon::now()->subDays(10),
            'cbu' => '48723313232712',
            'orden_medica' => 'examplefilename',
            'factura' => 'examplefilename2',
            'tipo_reintegro' => 'insumo',
            'estado' => 'Pendiente',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('reintegros')->insert($datosReintegro);
    }
}
