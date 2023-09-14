<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Status;
use App\Models\Student;
use App\Models\StudentGoal;
use App\Models\Trainer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(Rolseeder::class);

        /* Status::factory()->create([
            'status' => 'Activo'
        ]); */

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Admin');

        User::factory()->create([
            'name' => 'pepito',
            'email' => 'pepito@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Alumno');

        Student::create([
            'id_user' => 2,
            'name' => 'Pepito',
            'last_name' => 'Fuentes',
            'profile_picture_url' => ''
        ]);

        StudentGoal::create([
            'id_student' => 1,
            'name' => 'Bajar de peso',
            'description' => 'asd',
            'goal_status' => 'Iniciado'
        ]);

        User::factory()->create([
            'name' => 'juansito',
            'email' => 'juansito@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Trainer');

        Trainer::create([
            'id_user' => 3,
            'name' => 'Juansito',
            'last_name' => 'Shupa',
            'profile_picture_url' => ''
        ]);
    }
}
