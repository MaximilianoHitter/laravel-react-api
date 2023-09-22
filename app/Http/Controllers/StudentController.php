<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentGoalCollection;
use App\Http\Resources\StudentRoutineCollection;
use App\Models\Student;
use App\Models\StudentGoal;
use App\Models\TrainerRoutine;
use Illuminate\Http\Request;

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


    public function get_goals(Request $request){
        $student_id = $request->student_id;
        $goals = StudentGoal::where('id_student', $student_id)->get();
        return new StudentGoalCollection($goals);
    }

    public function get_routines(Request $request){
        //Harcodeado porque debería sacarse del Auth
        $student_id = 1;
        $rutinas = TrainerRoutine::where('id_student', $student_id)->get();
        return new StudentRoutineCollection($rutinas);
    }
}
