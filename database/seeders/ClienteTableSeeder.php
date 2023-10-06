<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datosCliente = [
            'usuario' => 'cliente',
            'password' => 'contraseña123',
            'nombre' => 'Cliente',
            'apellido' => 'Fake',
            'fecha_nacimiento' => '1990-01-01',
            'dni' => 12345678, // Cambia esto al valor deseado
            'email' => 'correo@gmail.com',
            'direccion' => '123 Calle Principal',
            'telefono' => '1234567890', // Cambia esto al valor deseado
            'plan_id' => 1, // Cambia esto al valor deseado
            'forma_pago' => 'Mensual', // Puedes cambiar esto a 'anual' o 'semestral' según necesites
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('clientes')->insert($datosCliente);
    }
}
