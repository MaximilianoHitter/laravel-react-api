<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoutineEventsController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\SpecialityPlanController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TrainerRoutineController;
use App\Http\Controllers\UserController;
use App\Models\TrainerRoutine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\PermissionServiceProvider;

use Illuminate\Support\Facades\Mail;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([], function () {
    Route::post('/permissions', [PermissionsController::class, 'index']);
});

/* Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::get('/tasks', [TaskController::class, 'index']);
});

Route::group([], function(){
    Route::get('/tasksUnsecure', [TaskController::class, 'index']);
}); */

Route::get('/status', [StatusController::class, 'status']);
Route::get('/roles', [StatusController::class, 'roles_publicos']);

//Rutas de rutinas
Route::group([], function () {
    Route::post('/trainerroutinest', [TrainerRoutineController::class, 'store']);
    Route::post('/trainer_routine_store', [TrainerRoutineController::class, 'new_store']);
    Route::post('/student_routines', [TrainerRoutineController::class, 'rutinas_de_alumno']);
    Route::post('/trainerroutinedl', [TrainerRoutineController::class, 'destroy']);
    Route::post('/trainer_routines', [TrainerRoutineController::class, 'rutinas_de_trainer']);
    Route::post('/get_routine', [TrainerRoutineController::class, 'show']);
    Route::post('/change_routine_status', [TrainerRoutineController::class, 'cambiar_estado']);
    Route::post('/borrar_rutina', [TrainerRoutineController::class, 'borrar_rutina']);
});

//Rutas de routine_event 
Route::group([], function(){
    Route::post('/routine_event_store', [RoutineEventsController::class, 'store']);
    Route::post('/borrar_evento', [RoutineEventsController::class, 'destroy']);
});

//Rutas de estados
Route::get('/get_estados', [TrainerRoutineController::class, 'estados']);

//Rutas de Trainer
Route::group([], function () {
    Route::get('/trainers', [TrainerController::class, 'index']);
    Route::get('/trainers/{id}', [TrainerController::class, 'show']);
    Route::get('/trainer_students', [TrainerController::class, 'get_students_requests']);
    Route::post('/change_status', [TrainerController::class, 'change_status']);
    Route::get('/certificates/{id_trainer}', [TrainerController::class, 'get_certificates']);
    Route::post('/change_student_trainer', [TrainerController::class, 'change_student_status']);
});

//Rutas de Alumno
Route::group([], function () {
    Route::post('/student_goals', [StudentController::class, 'get_goals']);
    Route::get('/get_student_goals', [StudentController::class, 'get_student_goals']);
    Route::get('/routines_student', [StudentController::class, 'get_routines']); //revisar en el front
    Route::post('/asign_trainer', [StudentController::class, 'asign_trainer']);
    Route::post('/is_connected_trainer', [StudentController::class, 'is_connected_trainer']);
    Route::get('/student_trainers', [StudentController::class, 'get_trainers']);
    Route::post('/set_feedback', [StudentController::class, 'set_feedback']);
    Route::get('/get_routines_unpayment', [StudentController::class, 'get_unpayed_routines']);
    Route::get('/goal/{goal_id}', [StudentController::class, 'get_goal']);
});

//Rutas de specialista
Route::group([], function(){
    Route::get('/specialist_requests', [SpecialistController::class, 'index']);
    Route::get('/get_plans', [SpecialistController::class, 'get_plans']);
    Route::get('/specialist_requests_admin', [SpecialistController::class, 'index_admin']);
    Route::post('/change_student_status', [SpecialistController::class, 'change_student_status']);
});

//Rutas de status_student 
Route::get('/status_student', [SpecialistController::class, 'get_estados']);

//Rutas de planes 
Route::group([],function(){
    Route::post('/get_planes_student', [SpecialityPlanController::class, 'index']);
    Route::post('/change_plan_status', [SpecialityPlanController::class, 'change_status']);
    Route::post('/borrar_plan', [SpecialityPlanController::class, 'borrar_plan']);
    Route::post('/plan_store', [SpecialityPlanController::class, 'store']);
});

//Rutas de Payment
Route::group([], function () {
    Route::post('/payment_store', [PaymentController::class, 'store']);
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::post('/set_payment_status', [PaymentController::class, 'change_status']);
});

//Rutas de prueba
Route::get('/all', [TrainerRoutineController::class, 'index']);

Route::get('/send-test-email', function (Request $request) {
    $to = 'test@example.com';
    $subject = 'Test Email';
    $message = 'This is a test email from Laravel!';

    Mail::raw($message, function ($mail) use ($to, $subject) {
        $mail->to($to)->subject($subject);
    });

    return 'Test email sent successfully!';
});

Route::get('/get-role', [PermissionsController::class, 'user_rol']);

Route::post('/set_profile_data', [StudentController::class, 'set_profile_data']);
Route::post('/set_perfil_data', [UserController::class, 'set_perfil_data']);

// Rutas que dependen del rol del usuario
Route::group([], function () {
    Route::get('/get_student_data/{id_user}', [StudentController::class, 'get_student_data']);
    Route::get('/get_trainer_data/{id_user}', [TrainerController::class, 'get_trainer_data']);
    Route::get('/get_specialist_data/{id_user}', [SpecialistController::class, 'get_specialist_data']);
});
