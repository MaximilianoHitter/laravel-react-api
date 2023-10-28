<?php

namespace App\Http\Controllers;

use App\Models\RoutineEvents;
use App\Models\Trainer;
use App\Models\TrainerRoutine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutineEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = Auth::id();//Auth::user()->id;
        $trainer = Trainer::where('id_user', $user_id)->first();
        $student_id = $request->student_id;
        $eventos = TrainerRoutine::where('id_trainer', $trainer->id)->where('id_student', $student_id)->with('events')->get();
        return response()->json([$eventos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fecha_a_comprobar = Carbon::parse($request->event_date);
        $trainer_routine = TrainerRoutine::find($request->trainer_routine_id);
        if($trainer_routine != null && $request->event_date != null){
            $fecha_inicio = Carbon::parse($trainer_routine->initial_date);
            $fecha_fin = Carbon::parse($trainer_routine->final_date);
            if($fecha_a_comprobar->gte($fecha_inicio) && $fecha_a_comprobar->lte($fecha_fin)){
                $routine_event = new RoutineEvents();
                $routine_event->date = $request->event_date;
                $routine_event->trainer_routine_id = $request->trainer_routine_id;
                $routine_event->description = $request->description;
                $routine_event->save();
                return response()->json(['success']);
            }else{
                return response()->json(['errors'=>['event_date'=>'La fecha está fuera del rango de las fechas de la rutina']], 422);
            }
        }else{
            return response()->json(['errors'=>['trainer_routine_id'=>'No se ha encontrado dicha rutina']], 422);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(RoutineEvents $routineEvents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoutineEvents $routineEvents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoutineEvents $routineEvents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->evento_id;
        $routine_event = RoutineEvents::find($id);
        if($routine_event != null){
            $routine_event->delete();
            return response()->json(['success']);
        }else{
            return response()->json(['errors'=>['general'=>'No se ha encontrado este evento']], 422);
        }
    }
}
