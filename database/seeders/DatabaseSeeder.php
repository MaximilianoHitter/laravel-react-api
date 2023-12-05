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
use App\Models\Payment;
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
            'name' => 'laura',
            'email' => 'laura@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Alumno');

        User::factory()->create([
            'name' => 'federico',
            'email' => 'fede@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Alumno');

        Student::create([
            'id_user' => 2,
            'name' => 'Laura',
            'last_name' => 'Gimenez',
            'profile_picture_url' => 'https://images.unsplash.com/photo-1590556409324-aa1d726e5c3c?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'day_of_birth' => '2000-05-14',
            'weight' => 70.50,
            'height' => 60.50
        ]);

        Student::create([
            'id_user' => 3,
            'name' => 'Federico',
            'last_name' => 'Valdez',
            'profile_picture_url' => 'https://images.unsplash.com/photo-1516442719524-a603408c90cb?q=80&w=869&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'day_of_birth' => '1996-05-14',
            'weight' => 75.60,
            'height' => 65.20
        ]);

        StudentGoal::create([
            'id_student' => 2,
            'name' => 'Ganar masa muscular',
            'description' => 'Quiero ganar masa muscular',
            'goal_status' => 'Iniciado'
        ]);

        StudentGoal::create([
            'id_student' => 1,
            'name' => 'Tonificar cuerpo',
            'description' => 'Me encuentro bien en mi peso, quiero mejorar mis músculos',
            'goal_status' => 'Iniciado'
        ]);

        User::factory()->create([
            'name' => 'gabriel',
            'email' => 'gabriel@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Trainer');

        User::factory()->create([
            'name' => 'jose',
            'email' => 'jose@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Trainer');

        Trainer::create([
            'id_user' => 4,
            'name' => 'Gabriel',
            'last_name' => 'Gonzalez',
            'profile_picture_url' => 'https://images.unsplash.com/photo-1584466977773-e625c37cdd50?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'day_of_birth' => '1994-04-11',
            'weight' => 45.50,
            'height' => 178.5,
            'description' => 'Especialista en aumentar masa muscular.'
        ]);

        Trainer::create([
            'id_user' => 5,
            'name' => 'Jose',
            'last_name' => 'Veiga',
            'profile_picture_url' => 'https://images.unsplash.com/photo-1619361728853-2542f3864532?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'day_of_birth' => '1997-04-11',
            'weight' => 69,
            'height' => 171,
            'description' => 'Especialista en resistencia.',
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
            'final_date' => '2023-12-05',
            'initial_date' => '2023-12-19',
            'id_routine_status' => 1,
            'id_payment' => 3,
            'amount' => 1500,
            'description' => 'Rutina para perder peso',
            'color' => '#FF00FF'
        ]);


        Payment::create([
            'id' => 3,
            'id_student' => 1,
            'amount' => 1500,
            'reason' => 'Por la rutina',
            'payment_type' => 'Transferencia',
            'status' => 'Aceptado',
            'path_archivo' => '',
        ]);

        RoutineEvents::create([
            'date' => '2023-12-05',
            'trainer_routine_id' => 1,
            'student_feedback' => null,
            'description' => '20 flexiones'
        ]);

        RoutineEvents::create([
            'date' => '2023-12-08',
            'trainer_routine_id' => 1,
            'student_feedback' => null,
            'description' => '100 abdominales'
        ]);

        RoutineEvents::create([
            'date' => '2023-12-09',
            'trainer_routine_id' => 1,
            'student_feedback' => null,
            'description' => 'trotar 1km'
        ]);

        TrainerRoutine::create([
            'id_student' => 1,
            'id_trainer' => 1,
            'id_student_goal' => 2,
            'name' => 'Correr en la semana',
            'final_date' => '2023-12-18',
            'initial_date' => '2023-12-24',
            'id_routine_status' => 1,
            'id_payment' => 4,
            'amount' => 1500,
            'description' => 'Rutina para mejorar cardio',
            'color' => '#FFFF00'
        ]);

        RoutineEvents::create([
            'date' => '2023-12-18',
            'trainer_routine_id' => 2,
            'student_feedback' => null,
            'description' => 'trotar 1km'
        ]);

        RoutineEvents::create([
            'date' => '2023-12-19',
            'trainer_routine_id' => 2,
            'student_feedback' => null,
            'description' => 'correr 20 minutos'
        ]);

        RoutineEvents::create([
            'date' => '2023-12-20',
            'trainer_routine_id' => 2,
            'student_feedback' => null,
            'description' => 'trotar y correr'
        ]);

        Payment::create([
            'id' => 4,
            'id_student' => 1,
            'amount' => 1500,
            'reason' => 'Por la rutina',
            'payment_type' => 'Transferencia',
            'status' => 'Ingresado',
            'path_archivo' => '',
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
            'name' => 'juan',
            'email' => 'juan@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Especialista');

        User::factory()->create([
            'name' => 'lucas',
            'email' => 'lucas@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Especialista');

        User::factory()->create([
            'name' => 'carla',
            'email' => 'carla@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ])->assignRole('Especialista');

        User::factory()->create([
            'name' => 'nicolas',
            'email' => 'nicolas@admin.com',
            'password' => Hash::make('admin'),
            'status' => 'Activo'
        ]);

        Specialist::create([
            'id_user' => 6,
            'name' => 'Juan',
            'last_name' => 'Martinez',
            'profile_picture_url' => 'https://img.freepik.com/foto-gratis/fisioterapeuta-ayudando-al-paciente-plano-medio_23-2149866151.jpg?w=740&t=st=1701546845~exp=1701547445~hmac=84cfa8e88daa32f968727c2218cbf2925b2dd5ec2d29adca057bd5d702d698e2',
            'day_of_birth' => '1978-01-08',
            'weight' => 71,
            'height' => 173,
            'description' => 'Kinesiólogo deportivo.'
        ]);

        Specialist::create([
            'id_user' => 7,
            'name' => 'Lucas',
            'last_name' => 'Vitto',
            'profile_picture_url' => 'https://img.freepik.com/foto-gratis/terapeuta-tiro-medio-portapapeles-mirando-mujer_23-2148759111.jpg?w=740&t=st=1701548056~exp=1701548656~hmac=e781c71d96e4471215e8731c5d522979d2686c031586ce6c638a43312651da8e',
            'day_of_birth' => '1980-08-24',
            'weight' => 78,
            'height' => 180,
            'description' => 'Mente sana, cuerpo sano, mayor rendimiento.'
        ]);

        Specialist::create([
            'id_user' => 8,
            'name' => 'Carla',
            'last_name' => 'Maiar',
            'profile_picture_url' => 'https://img.freepik.com/foto-gratis/retrato-doctor_144627-39387.jpg?w=740&t=st=1701547063~exp=1701547663~hmac=9bd932585ea9d66c3497ceccaab3082b96754153f53399df08f1ebd79e2e67ce',
            'day_of_birth' => '1983-09-14',
            'weight' => 65,
            'height' => 167,
            'description' => 'Orden nutricional para mejorar tu rendimiento.'
        ]);

        Specialist::create([
            'id_user' => 9,
            'name' => 'Nicolas',
            'last_name' => 'Perez',
            'profile_picture_url' => 'https://img.freepik.com/foto-gratis/hombres-medico-vendaje-pie-paciente-femenino_1170-2174.jpg?w=740&t=st=1701547182~exp=1701547782~hmac=297143a74c117bad5610c2ac954abd3b24f334342b855aba92e214b1080d8b7a',
            'day_of_birth' => '1985-11-30',
            'weight' => 79,
            'height' => 181,
            'description' => 'Traumatólogo deportivo.'
        ]);

        Social::create([
            'id_user' => 6,
            'facebook' => 'https://www.facebook.com/juan',
            'instagram' => 'https://www.instagram.com/juan',
            'twitter' => 'https://www.twitter.com/juan',
            'linkedin' => 'https://www.linkedin.com/in/juan'
        ]);

        Social::create([
            'id_user' => 7,
            'facebook' => 'https://www.facebook.com/lucas',
            'instagram' => 'https://www.instagram.com/lucas',
            'twitter' => 'https://www.twitter.com/lucas',
            'linkedin' => 'https://www.linkedin.com/in/lucas'
        ]);

        Social::create([
            'id_user' => 8,
            'facebook' => 'https://www.facebook.com/carla',
            'instagram' => 'https://www.instagram.com/carla',
            'twitter' => 'https://www.twitter.com/carla',
            'linkedin' => 'https://www.linkedin.com/in/carla'
        ]);

        Social::create([
            'id_user' => 9,
            'facebook' => 'https://www.facebook.com/nicolas',
            'instagram' => 'https://www.instagram.com/nicolas',
            'twitter' => 'https://www.twitter.com/nicolas',
            'linkedin' => 'https://www.linkedin.com/in/nicolas'
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

        SpecialistBranch::create([
            'id_specialist' => 4,
            'id_branch' => 3
        ]);

        SpecialistStudent::create([
            'student_id' => 1,
            'specialist_id' => 1,
            'status_student_id' => 2,
            'date' => '2023-10-29'
        ]);

        /* SpecialityPlan::create([
            'student_id' => 1,
            'specialist_id' => 1,
            'name' => "pruebita",
            'description' => 'asdasdasd',
            'initial_date' => '2023-10-29',
            'final_date' => '2023-10-31',
            'id_plan_status' => 1,
            'amount' => 1800,
            'color' => '#FF0000'
        ]); */

        //generar planes a mansalva
        SpecialityPlan::create([
            'student_id' => 1,
            'specialist_id' => 1,
            'name' => "Movimientos articulares",
            'description' => 'Realizar 3 veces al día movimientos en la articulación de la rodilla',
            'initial_date' => '2023-12-04',
            'final_date' => '2023-12-10',
            'id_plan_status' => 1,
            'amount' => 2500,
            'color' => '#7FB3D5',
            'id_payment' => 1
        ]);

        Payment::create([
            'id' => 1,
            'id_student' => 1,
            'amount' => 2500,
            'reason' => 'Por el plan',
            'payment_type' => 'Transferencia',
            'status' => 'Aceptado',
            'path_archivo' => '',
        ]);

        SpecialityPlan::create([
            'student_id' => 1,
            'specialist_id' => 1,
            'name' => "Ejercicios de equilibrio",
            'description' => 'Realizar 3 veces al día ejercicios de equilibrio en la pierna derecha',
            'initial_date' => '2023-12-11',
            'final_date' => '2023-12-17',
            'id_plan_status' => 1,
            'amount' => 2500,
            'color' => '#F0B27A',
            'id_payment' => 2
        ]);

        Payment::create([
            'id' => 2,
            'id_student' => 1,
            'amount' => 2500,
            'reason' => 'Por el plan',
            'payment_type' => 'Transferencia',
            'status' => 'Iniciado',
            'path_archivo' => '',
        ]);

        SpecialityPlan::create([
            'student_id' => 1,
            'specialist_id' => 1,
            'name' => "Ejercicios de flexibilidad",
            'description' => 'Realizar 3 veces al día ejercicios de flexibilidad en la pierna derecha',
            'initial_date' => '2023-12-18',
            'final_date' => '2023-12-24',
            'id_plan_status' => 1,
            'amount' => 2500,
            'color' => '#F0B27A',
        ]);
    }
}
