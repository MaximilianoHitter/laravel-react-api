<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainerRoutineStoreRequest;
use App\Models\RoutineEvents;
use App\Models\Status;
use App\Models\Trainer;
use App\Models\TrainerRoutine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StudentRoutineCollection;

class TrainerRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TrainerRoutine::with('events')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrainerRoutineStoreRequest $request)
    {
        $asd = $request;
        //return $request;
        $user_id = 4;//Auth::user()->id;
        $trainer = Trainer::where('id_user', $user_id)->first();
        //return $trainer;
        $routine = new TrainerRoutine();
        $routine->id_student = $request->id_student;
        $routine->id_trainer = $trainer->id;
        $routine->id_student_goal = $request->id_student_goal;
        $routine->name = $request->name;
        $routine->initial_date = $request->initial_date;
        $routine->final_date = $request->final_date;
        $status = Status::find(1);
        $routine->id_routine_status = $status->id;
        $routine->amount = $request->amount;
        $routine->id_payment = null;
        $routine->description = $request->descriptions;
        

        $initial_date = Carbon::parse($request->initial_date);
        $nueva_fecha_inicial = $initial_date->format('Y-m-d');
        $final_date = Carbon::parse($request->final_date);
        $cantidad_de_dias = $initial_date->diffInDays($final_date);
        //ver que las fechas de la rutina no estén intercambiadas
        if($initial_date > $final_date){
            return response()->json(['errors'=>['initial_date'=>'La fecha de inicio no puede ser mayor a la fecha de fin', 'final_date'=>'La fecha de fin no puede ser menor a la fecha de inicio']], 422);
        }
        //ver que las fechas no estén dentro de otra rutina 
        $rutinas_entrecruzadas_initial = TrainerRoutine::where('id_trainer', $trainer->id)
        ->where('id_student', $request->id_student)
        ->whereDate('initial_date', '<=', $initial_date)->whereDate('final_date', '>=', $initial_date)->get();
        if(count($rutinas_entrecruzadas_initial) > 0){
            return response()->json(['errors'=>['initial_date'=>'La fecha de inicio se encuentra dentro de otra rutina']], 422);
        }
        $rutinas_entrecruzadas_final = TrainerRoutine::where('id_trainer', $trainer->id)
        ->where('id_student', $request->id_student)
        ->whereDate('initial_date', '<=', $final_date)->whereDate('final_date', '>=', $final_date)->get();
        if(count($rutinas_entrecruzadas_final) > 0){
            return response()->json(['errors'=>['final_date'=>'La fecha de fin se encuentra dentro de otra rutina']], 422);
        }


        $routine->save();
        //$cantidad_de_dias+= 1;
        $descriptions = $request->descriptions;
        $descriptions = explode('|', $descriptions);
        for ($i=0; $i < $cantidad_de_dias; $i++) { 
            $date_event = $nueva_fecha_inicial;
            $routine_event = new RoutineEvents();
            $routine_event->trainer_routine_id = $routine->id;
            $nueva_fecha = Carbon::parse($date_event);
            $nueva_fecha = $nueva_fecha->addDays($i);
            $routine_event->date = $nueva_fecha;
            $nueva_fecha = null;
            $routine_event->student_feedback = '';
            if(array_key_exists($i, $descriptions)){
                $routine_event->description = trim($descriptions[$i]);
            }else{
                $routine_event->description = trim($descriptions[0]);
            }
            $routine_event->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainerRoutine $trainerRoutine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainerRoutine $trainerRoutine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $trainer_routine = TrainerRoutine::find($request->rutina_id);
        RoutineEvents::where('trainer_routine_id', $trainer_routine->id)->delete();
        $trainer_routine->delete();
        return response()->json(['data'=>'success'], 200);
    }

    public function rutinas_de_alumno(Request $request){
        //hay que validar que existe el alumno del id
        $rutinas = TrainerRoutine::with('events')->where('id_trainer', 1)->where('id_student', $request->student_id)->get();
        return New StudentRoutineCollection($rutinas);
    }
}
