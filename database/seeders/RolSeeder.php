<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1=Role::create(['name' => 'Admin']);
        $role2=Role::create(['name' => 'Trainer']);
        $role3=Role::create(['name' => 'Moderador']); 
        $role4=Role::create(['name' => 'Especialista']); 
        $role5=Role::create(['name' => 'Alumno']); 
        $role6=Role::create(['name' => 'Guest']); 

        $permission = Permission::create(['name' => 'PermisoAdmin'])->assignRole([$role1]);
        $permission = Permission::create(['name' => 'PermisoTrainer'])->assignRole([$role2]);
        $permission = Permission::create(['name' => 'PermisoModerador'])->assignRole([$role3]);
        $permission = Permission::create(['name' => 'PermisoEspecialista'])->assignRole([$role4]);
        $permission = Permission::create(['name' => 'PermisoAlumno'])->assignRole([$role5]);
        $permission = Permission::create(['name' => 'PermisoGuest'])->assignRole([$role6]);
        
    }
}
