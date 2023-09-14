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

class TrainerRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrainerRoutineStoreRequest $request)
    {
        $asd = $request;
        //return $request;
        $user_id = 1;//Auth::user()->id;
        $trainer = Trainer::where('id_user', $user_id)->first();
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
        $routine->save();

        $initial_date = Carbon::parse($request->initial_date);
        $final_date = Carbon::parse($request->final_date);
        $cantidad_de_dias = $initial_date->diffInDays($final_date);
        $cantidad_de_dias+= 1;
        $descriptions = $request->descriptions;
        for ($i=0; $i <= $cantidad_de_dias; $i++) { 
            $date_event = $initial_date;
            $routine_event = new RoutineEvents();
            $routine_event->id_routine = $routine->id;
            $routine_event->date = $date_event->addDays($i);
            $routine_event->student_feedback = '';
            $routine_event->description = $descriptions[$i];
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
    public function destroy(TrainerRoutine $trainerRoutine)
    {
        //
    }
}
