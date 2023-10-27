<?php

namespace App\Http\Controllers;

use App\Models\RoutineEvents;
use App\Models\Trainer;
use App\Models\TrainerRoutine;
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
        $routine_event = new RoutineEvents();
        $routine_event->date = $request->event_date;
        $routine_event->trainer_routine_id = $request->trainer_routine_id;
        $routine_event->description = $request->description;
        $routine_event->save();
        return response()->json(['success']);
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
    public function destroy(RoutineEvents $routineEvents)
    {
        //
    }
}
