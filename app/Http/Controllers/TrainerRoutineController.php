<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainerRoutineShowRequest;
use App\Http\Requests\TrainerRoutineStoreRequest;
use App\Models\RoutineEvents;
use App\Models\Status;
use App\Models\Trainer;
use App\Models\TrainerRoutine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StudentRoutineCollection;
use App\Models\Student;

class TrainerRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TrainerRoutine::with('events')->get();
    }

    public function new_store(TrainerRoutineStoreRequest $request){
        $user_id = Auth::id();//Auth::user()->id;
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
        $routine->color = $request->color;
        $routine->save();
        return response()->json(['success'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrainerRoutineStoreRequest $request)
    {
        $asd = $request;
        //return $request;
        $user_id = Auth::id();//Auth::user()->id;
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
        $routine->description = implode(' | ', $request->descriptions);
        $routine->color = $request->color;
        

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
        $cantidad_de_dias = $cantidad_de_dias+1;
        if($request->initial_date == $request->final_date){
            $cantidad_de_dias = 1;
        }
       
        $descriptions = $request->descriptions;
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
    public function show(TrainerRoutineShowRequest $request)
    {
        $routine = TrainerRoutine::where('id', $request->trainerroutine_id)->with('trainer')->first();
        return response()->json(['data'=>$routine]);
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
        $user_id = Auth::id();
        $trainer = Trainer::where('id_user', $user_id)->first();
        $rutinas = TrainerRoutine::with('events', 'goal', 'status')->where('id_trainer', $trainer->id)->where('id_student', $request->student_id)->get();
        $rutinas_a_devolver = [];
        foreach ($rutinas as $key => $rutina) {
            $descripcion = [];
            foreach ($rutina->events as $key => $evento) {
                array_push($descripcion, $evento->description);
            }
            $rutina->description = $descripcion;
            $rutinas_a_devolver[] = $rutina;
        }
        return New StudentRoutineCollection($rutinas_a_devolver);
    }

    public function rutinas_de_trainer(Request $request){
        //hay que validar que existe el alumno del id
        $user_id = Auth::id();
        $student = Student::where('id_user', $user_id)->first();
        $trainer_id = $request->trainer_id;

        $eventos = RoutineEvents::with('routine', 'routine.payment')->whereHas('routine', function($query) use ($trainer_id, $student){
            $query->where('id_trainer', $trainer_id)->where('id_student', $student->id);
        })->get();
        return new StudentRoutineCollection($eventos);
    }

    public function estados(){
        $estados = Status::all();
        return new StudentRoutineCollection($estados);
    }

    public function cambiar_estado(Request $request){
        $id = $request->estado_id;
        $rutina_id = $request->rutina_id;
        $rutina = TrainerRoutine::find($rutina_id);
        if($rutina != null){
            $rutina->id_routine_status = $id;
            $rutina->save();
            return response()->json(['success']);
        }else{
            return response()->json(['errors'=>['rutina_id'=>'No se encontro la rutina']]);
        }
    }

    public function borrar_rutina(Request $request){
        $id = $request->routine_id;
        $rutina = TrainerRoutine::find($id);
        if($rutina != null){
            $eventos = RoutineEvents::where('trainer_routine_id', $id)->get();
            foreach ($eventos as $key => $value) {
                $value->delete();
            }
            $rutina->delete();
            return response()->json(['success']);
        }else{
            return response()->json(['errors'=>['general'=>'Algo paso']], 422);
        }
    }
}
