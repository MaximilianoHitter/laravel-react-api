<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralCollection;
use App\Http\Resources\StudentGoalCollection;
use App\Http\Resources\StudentRoutineCollection;
use App\Models\RoutineEvents;
use App\Models\Student;
use App\Models\StudentGoal;
use App\Models\Trainer;
use App\Models\TrainerRoutine;
use App\Models\TrainerStudent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }


    public function get_goals(Request $request)
    {
        $student_id = $request->student_id;
        $goals = StudentGoal::where('id_student', $student_id)->get();
        return new StudentGoalCollection($goals);
    }

    public function get_student_goals(){
        //obtener por Auth despues
        $user_id = Auth::id();
        $student = Student::find('id_user', $user_id)->get();
        $goals = StudentGoal::where('id_student', $student->id)->get();
        return new StudentGoalCollection($goals);
    }

    public function get_routines(Request $request){
        $user_id = Auth::id();
        $student = Student::find('id_user', $user_id)->get();
        $rutinas = TrainerRoutine::with('events')
            ->where('id_student', $student->id)
            ->get();
        return new StudentRoutineCollection($rutinas);
    }

    public function asign_trainer(Request $request)
    {
        $trainer = Trainer::find($request->trainer_id);
        $user_id = Auth::id();
        $student = Student::find('id_user', $user_id)->get();
        $trainer_student = new TrainerStudent();
        $trainer_student->student_id = $student->id;
        $trainer_student->trainer_id = $trainer->id;
        $trainer_student->status = 'Inactivo';
        $trainer_student->date = Carbon::now()->format('Y-m-d');
        $trainer_student->save();
        return response()->json(['data' => 'success'], 200);
    }

    public function is_connected_trainer(Request $request)
    {
        $trainer = Trainer::find($request->trainer_id);
        $user_id = Auth::id();
        $student = Student::find('id_user', $user_id)->get();
        $trainer_student = TrainerStudent::where('student_id', $student->id)
            ->where('trainer_id', $trainer->id)
            ->first();
        if ($trainer_student) {
            return response()->json(['data' => true]);
        } else {
            return response()->json(['data' => false]);
        }
    }

    public function get_trainers(){
        $id_student=1;
        $student = Student::with('trainers')->find($id_student);
        $trainers = $student->trainers;
        return new GeneralCollection($trainers);
    }

    public function set_feedback(Request $request){
        $event_id = $request->id_evento;
        $feedback = $request->feedback;
        $evento = RoutineEvents::find($event_id);
        $evento->student_feedback = $feedback;
        $evento->save();
        return response()->json(['data'=>'success'], 200);
    }
}
