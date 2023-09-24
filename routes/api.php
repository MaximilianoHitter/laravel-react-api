<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TrainerRoutineController;
use App\Models\TrainerRoutine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\PermissionServiceProvider;

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

Route::group([], function(){
    Route::get('/permissions/{url}', [PermissionsController::class, 'index']);
});

/* Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::get('/tasks', [TaskController::class, 'index']);
});

Route::group([], function(){
    Route::get('/tasksUnsecure', [TaskController::class, 'index']);
}); */

Route::get('/status', [StatusController::class, 'status']);
Route::get('/roles', [StatusController::class, 'roles_publicos']);

Route::group([], function(){
    Route::post('/trainerroutinest', [TrainerRoutineController::class, 'store']);
    Route::post('/student_routines', [TrainerRoutineController::class, 'rutinas_de_alumno']);
    Route::post('/trainerroutinedl', [TrainerRoutineController::class, 'destroy']);
});

Route::group([], function(){
    Route::get('/trainers', [TrainerController::class, 'index']);
    Route::get('/trainers/{id}', [TrainerController::class, 'show']);
    Route::get('/trainer_students', [TrainerController::class, 'get_students_requests']);
    Route::post('/change_status', [TrainerController::class, 'change_status']);

});

Route::group([], function(){
    Route::post('/student_goals', [StudentController::class, 'get_goals']);
    Route::get('/student_routines', [StudentController::class, 'get_routines']);
    Route::post('/asign_trainer', [StudentController::class, 'asign_trainer']);
    Route::post('/is_connected_trainer', [StudentController::class, 'is_connected_trainer']);
});

//Rutas de prueba
Route::get('/all', [TrainerRoutineController::class, 'index']);




