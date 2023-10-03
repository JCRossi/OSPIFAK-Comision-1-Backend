<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'usuario'=> '11111111',
            'password' => bcrypt('admin123'),
            'remember_token' => 'abcd',
            'nombre' => 'Administrador',
        ])->assignRole('Administrador');

        User::create([
            'usuario' => '22222222',
            'password' =>  bcrypt('empleado123'),
            'nombre' => 'Empleado',
        ])->assignRole('Empleado');
    }
}