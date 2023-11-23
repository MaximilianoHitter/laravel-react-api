<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RoutineEvents;
use App\Models\Specialist;
use App\Models\SpecialistStudent;
use App\Models\SpecialityPlan;
use App\Models\Status;
use App\Models\StatusStudent;
use App\Models\Student;
use App\Models\StudentGoal;
use App\Models\Social;
use App\Models\Trainer;
use App\Models\TrainerRoutine;
use App\Models\TrainerStudent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Branch;
use App\Models\SpecialistBranch;

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
            'status' => 'Activo',
        ]);

        Status::create(['status' => 'Inactivo']);

        StatusStudent::create(['status' => 'Pendiente']);
        StatusStudent::create(['status' => 'Activo']);
        StatusStudent::create(['status' => 'Cancelado']);

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
            'weight' => 70.50,
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
            'profile_picture_url' => 'https://images.unsplash.com/photo-1645544622368-c4b690a13e67?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8TGVnb2xhc3xlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80',
            'day_of_birth' => '1994-04-11',
            'weight' => 45.50,
            'height' => 178.5,
            'description' => 'Especialista en Tonificar los cojone'
        ]);

        TrainerStudent::create([
            'student_id' => 1,
            'trainer_id' => 1,
            'status_student_id' => 2,
            'date' => '2023-09-18'
        ]);

        TrainerRoutine::create([
            'id_student' => 1,
            'id_trainer' => 1,
            'id_student_goal' => 2,
            'name' => 'Perder peso',
            'final_date' => '2023-09-21',
            'initial_date' => '2023-09-19',
            'id_routine_status' => 1,
            'id_payment' => null,
            'amount' => 1500,
            'description' => 'Hacer el dia 1 | Hacer el dia 2 | Hacer el dia 3',
            'color' => '#FF0000'
        ]);

        RoutineEvents::create([
            'date' => '2023-09-19',
            'trainer_routine_id' => 1,
            'student_feedback' => null,
            'description' => 'Hacer el dia 1'
        ]);

        RoutineEvents::create([
            'date' => '2023-09-20',
            'trainer_routine_id' => 1,
            'student_feedback' => null,
            'description' => 'Hacer el dia 2'
        ]);

        RoutineEvents::create([
            'date' => '2023-09-21',
            'trainer_routine_id' => 1,
            'student_feedback' => null,
            'description' => 'Hacer el dia 3'
        ]);

        Branch::create([
            'name' => 'Kinesiólogo',
            'description' => 'Especialista para prevenir y tratar lesiones deportivas.',
        ]);
        Branch::create([
            'name' => 'Nutricionista',
            'description' => 'Diseña planes alimenticios para mejorar la salud de los deportistas.',
        ]);
        Branch::create([
            'name' => 'Traumatólogo',
            'description' => 'Diagnostica, trata y rehabilita lesiones de los huesos y articulaciones.',
        ]);
        Branch::create([
            'name' => 'Psicólogo',
            'description' => 'Ayuda a los deportistas a superar sus problemas emocionales y mentales.',
        ]);

        User::factory()->create([
            'name' => 'gandalf',
            'email' => 'gandalf@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Especialista');

        User::factory()->create([
            'name' => 'elrond',
            'email' => 'elrond@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Especialista');

        User::factory()->create([
            'name' => 'balrog',
            'email' => 'balrog@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Especialista');

        Specialist::create([
            'id_user' => 5,
            'name' => 'Gandalf',
            'last_name' => 'The Gray',
            'profile_picture_url' => 'https://images.unsplash.com/photo-1600637453426-7c64826b19d9?auto=format&fit=crop&q=80&w=1288&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'day_of_birth' => '1550-01-01',
            'weight' => 80,
            'height' => 200,
            'description' => 'Un mago pesa lo que debe pesar, ni mas, ni menos.'
        ]);

        Specialist::create([
            'id_user' => 6,
            'name' => 'Elrond',
            'last_name' => '',
            'profile_picture_url' => 'https://static.wikia.nocookie.net/lotr/images/9/9f/Elrond_of_Rivendell.jpg/revision/latest/scale-to-width-down/1200?cb=20230718101143',
            'day_of_birth' => '532-01-01',
            'weight' => 86,
            'height' => 188,
            'description' => 'Soy muy fuerte y sabio, nadie me para.'
        ]);

        Specialist::create([
            'id_user' => 7,
            'name' => 'Balrog',
            'last_name' => 'Maiar',
            'profile_picture_url' => 'https://i.pinimg.com/736x/cb/6c/a8/cb6ca80b0607d4026165fd9b74d958d9.jpg',
            'day_of_birth' => '400-01-01',
            'weight' => 500,
            'height' => 428,
            'description' => 'Roar.'
        ]);

        Social::create([
            'id_user' => 5,
            'facebook' => 'https://www.facebook.com/gandalf',
            'instagram' => 'https://www.instagram.com/gandalf',
            'twitter' => 'https://www.twitter.com/gandalf',
            'linkedin' => 'https://www.linkedin.com/in/gandalf'
        ]);

        Social::create([
            'id_user' => 6,
            'facebook' => 'https://www.facebook.com/elrond',
            'instagram' => 'https://www.instagram.com/elrond',
            'twitter' => 'https://www.twitter.com/elrond',
            'linkedin' => 'https://www.linkedin.com/in/elrond'
        ]);

        Social::create([
            'id_user' => 7,
            'facebook' => 'https://www.facebook.com/balrog',
            'instagram' => 'https://www.instagram.com/balrog',
            'twitter' => 'https://www.twitter.com/balrog',
            'linkedin' => 'https://www.linkedin.com/in/balrog'
        ]);

        SpecialistBranch::create([
            'id_specialist' => 1,
            'id_branch' => 1
        ]);

        SpecialistBranch::create([
            'id_specialist' => 2,
            'id_branch' => 4
        ]);

        SpecialistBranch::create([
            'id_specialist' => 3,
            'id_branch' => 2
        ]);

        SpecialistStudent::create([
            'student_id' => 1,
            'specialist_id' => 1,
            'status_student_id' => 2,
            'date' => '2023-10-29'
        ]);

        SpecialityPlan::create([
            'student_id' => 1,
            'specialist_id' => 1,
            'name' => "pruebita",
            'description' => 'asdasdasd',
            'initial_date' => '2023-10-29',
            'final_date' => '2023-10-31',
            'id_plan_status' => 1,
            'amount' => 1800,
            'color' => '#FF0000'
        ]);
    }
}
