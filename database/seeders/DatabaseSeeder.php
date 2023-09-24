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
            'name' => 'merrin',
            'email' => 'merrin@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Alumno');

        User::factory()->create([
            'name' => 'pipin',
            'email' => 'pipin@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Alumno');

        Student::create([
            'id_user' => 2,
            'name' => 'Merrin',
            'last_name' => 'Brandigamo',
            'profile_picture_url' => '',
            'day_of_birth' => '2000-05-14',
            'weigth' => 70.50,
            'height' => 60.50
        ]);

        Student::create([
            'id_user' => 3,
            'name' => 'Pipin',
            'last_name' => 'Tuk',
            'profile_picture_url' => '',
            'day_of_birth' => '1996-05-14',
            'weight' => 75.60,
            'height' => 65.20
        ]);

        StudentGoal::create([
            'id_student' => 2,
            'name' => 'Conseguir cerveza',
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
            'name' => 'legolas',
            'email' => 'legolas@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Trainer');

        Trainer::create([
            'id_user' => 4,
            'name' => 'Legolas',
            'last_name' => 'Hojaverde',
            'profile_picture_url' => '',
            'day_of_birth' => '1994-04-11',
            'weight' => 45.50,
            'height' => 178.5,
            'description' => 'Especialista en Tonificar los cojone'
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
            'id_student_goal'=>2,
            'name'=>'Perder peso',
            'final_date'=>'2023-09-21',
            'initial_date'=>'2023-09-19',
            'id_routine_status'=>1,
            'id_payment'=>null,
            'amount'=>1500,
            'description'=>'Hacer el dia 1 | Hacer el dia 2 | Hacer el dia 3'
        ]);

        RoutineEvents::create([
            'date'=>'2023-09-19',
            'trainer_routine_id'=>1,
            'student_feedback'=>null,
            'description'=>'Hacer el dia 1'
        ]);

        RoutineEvents::create([
            'date'=>'2023-09-20',
            'trainer_routine_id'=>1,
            'student_feedback'=>null,
            'description'=>'Hacer el dia 2'
        ]);

        RoutineEvents::create([
            'date'=>'2023-09-21',
            'trainer_routine_id'=>1,
            'student_feedback'=>null,
            'description'=>'Hacer el dia 3'
        ]);
    }
}
