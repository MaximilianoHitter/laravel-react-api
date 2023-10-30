<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralCollection;
use App\Models\Specialist;
use App\Models\SpecialistStudent;
use App\Models\SpecialityPlan;
use App\Models\StatusStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $specialist = Specialist::where('id_user', $user_id)->first();
        $requests = $specialist->students;
        $salida = [];
        foreach ($requests as $key => $value) {
            $value->status_student_id = $value->pivot->status_student_id;
            $value->date = $value->pivot->date;
            $value->pivot_id = $value->pivot->id;
            $salida[] = $value;
        }
        return new GeneralCollection($salida);
    }

    public function index_admin(){
        $user_id = Auth::id();
        $specialist = Specialist::where('id_user', $user_id)->first();
        $request = SpecialistStudent::where('specialist_id', $specialist->id)->with('student', 'status_student')->get();
        $salida = [];
        foreach ($request as $key => $value) {
            $request[$key]->name = $value->student->name.' '.$value->student->last_name;
        }
        return new GeneralCollection($request);
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
    public function show(Specialist $specialist)
    {
        //
        return response()->json(['specialists' => Specialist::all()]);
    }

    public function show_id($id_specialist)
    {
        $specialist = Specialist::where('id_user', $id_specialist)
            ->first();
        return response()->json(['data' => $specialist]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialist $specialist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialist $specialist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialist $specialist)
    {
        //
    }

    public function get_specialist_data($id_specialist)
    {
        $specialist = Specialist::where('id_user', $id_specialist)
            ->first();
        return response()->json(['data' => $specialist]);
    }

    public function get_plans(){
        $user_id = Auth::id();
        $specialist = Specialist::where('id_user', $user_id)->first();
        $planes = SpecialityPlan::where('specialist_id', $user_id)->get();
        return new GeneralCollection($planes);
    }

    public function get_estados(){
        $estados = StatusStudent::all();
        return new GeneralCollection($estados);
    }

    public function change_student_status(Request $request){
        $relacion_id = $request->relation_id;
        $intermedia = SpecialistStudent::find($relacion_id);
        if($intermedia != null){
            $intermedia->status_student_id = $request->estado_id;
            $intermedia->save();
            return response()->json(['success']);
        }else{
            return response()->json(['errors'=>['general'=>'algo paso']], 422);
        }
    }
}
