<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RoutineEvents;
use App\Models\Status;
use App\Models\Student;
use App\Models\StudentGoal;
use App\Models\Trainer;
use App\Models\TrainerRoutine;
use App\Models\TrainerStudent;
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

        Status::create([
            'status' => 'Activo'
        ]);

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

        User::factory()->create([
            'name' => 'pipito',
            'email' => 'pipito@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Alumno');

        Student::create([
            'id_user' => 2,
            'name' => 'Pepito',
            'last_name' => 'Fuentes',
            'profile_picture_url' => ''
        ]);

        Student::create([
            'id_user' => 3,
            'name' => 'Pipito',
            'last_name' => 'Paredes',
            'profile_picture_url' => ''
        ]);

        StudentGoal::create([
            'id_student' => 2,
            'name' => 'Subit de peso',
            'description' => 'asd',
            'goal_status' => 'Iniciado'
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
            'id_user' => 4,
            'name' => 'Juansito',
            'last_name' => 'Shupa',
            'profile_picture_url' => ''
        ]);

        TrainerStudent::create([
            'student_id'=>1,
            'trainer_id'=>1,
            'status'=>'Activo',
            'date'=>'2023-09-18'
        ]);

        TrainerRoutine::create([
            'id_student'=>1,
            'id_trainer'=>1,
            'id_student_goal'=>1,
            'name'=>'Perder peso',
            'final_date'=>'2023-09-19',
            'initial_date'=>'2023-09-21',
            'id_routine_status'=>1,
            'id_payment'=>null,
            'amount'=>1500
        ]);

        RoutineEvents::create([
            'date'=>'2023-09-19',
            'id_routine'=>1,
            'student_feedback'=>null,
            'description'=>'Hacer el dia 1'
        ]);

        RoutineEvents::create([
            'date'=>'2023-09-20',
            'id_routine'=>1,
            'student_feedback'=>null,
            'description'=>'Hacer el dia 2'
        ]);

        RoutineEvents::create([
            'date'=>'2023-09-21',
            'id_routine'=>1,
            'student_feedback'=>null,
            'description'=>'Hacer el dia 3'
        ]);
    }
}
