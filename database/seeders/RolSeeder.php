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
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Trainer']);
        $role3 = Role::create(['name' => 'Moderador']);
        $role4 = Role::create(['name' => 'Especialista']);
        $role5 = Role::create(['name' => 'Alumno']);
        $role6 = Role::create(['name' => 'Guest']);

        Permission::create(['name' => 'todo'])->assignRole([$role1]);
        /*  Permission::create(['name'=>'calendario'])->assignRole([$role2]); */
        Permission::create(['name' => 'trainers'])->assignRole([$role5, $role1]);
        Permission::create(['name' => 'trainers/{id}'])->assignRole([$role5]);
        Permission::create(['name' => 'specialists'])->assignRole([$role5, $role1]);
        Permission::create(['name' => 'specialists/{id}'])->assignRole([$role5, $role1]);
        Permission::create(['name' => 'student_routines'])->assignRole([$role5]);
        Permission::create(['name' => 'trainer_request'])->assignRole([$role2]);
        Permission::create(['name' => 'payment'])->assignRole([$role5]);
        Permission::create(['name' => 'payments'])->assignRole([$role2, $role4]);
        Permission::create(['name' => 'metricas'])->assignRole([$role5]);
        Permission::create(['name' => 'exercises'])->assignRole([$role5, $role2]);
        Permission::create(['name' => 'trainer_routines'])->assignRole([$role2]);
        Permission::create(['name' => 'specialist_plans'])->assignRole([$role4]);
        Permission::create(['name' => 'specialist_request'])->assignRole([$role4]);
        Permission::create(['name'=> 'student_payment'])->assignRole([$role5]);
        Permission::create(['name'=>'student_plans'])->assignRole([$role5]);
    }
}
