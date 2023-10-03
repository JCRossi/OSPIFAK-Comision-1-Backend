<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name'=>'Administrador']);
        $role2 = Role::create(['name'=>'Empleado']);

        Permission::create(['name'=>'empleados.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'empleados.create'])->syncRoles([$role1]); 
        Permission::create(['name'=>'planes.index'])->syncRoles([$role1]); 

        Permission::create(['name'=>'cliente.index'])->syncRoles([$role2]); 
    }
}
