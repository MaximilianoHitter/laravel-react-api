<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralCollection;
use App\Models\Specialist;
use App\Models\SpecialityPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialityPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $specialist = Specialist::where('id_user', $user_id)->first();
        $student_id = $request->student_id;
        $planes = SpecialityPlan::where('student_id', $student_id)->where('specialist_id', $specialist->id)->with('student', 'payment', 'status')->get();
        return new GeneralCollection($planes);
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
        $user_id = Auth::id();
        $specialist = Specialist::where('id_user', $user_id)->first();
        $plan = new SpecialityPlan();
        $plan->student_id = $request->student_id;
        $plan->specialist_id = $specialist->id;
        $plan->name = $request->name;
        $plan->description = $request->descriptions;
        $plan->initial_date = $request->initial_date;
        $plan->final_date = $request->final_date;
        $plan->id_plan_status = 1;
        $plan->amount = $request->amount;
        $plan->color = $request->color;
        $plan->save();
        return response()->json(['success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialityPlan $specialityPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialityPlan $specialityPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecialityPlan $specialityPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialityPlan $specialityPlan)
    {
        //
    }

    public function change_status(Request $request){
        $plan = SpecialityPlan::find($request->plan_id);
        $estado_id = $request->estado_id;
        if($plan != null){
            $plan->id_plan_status = $estado_id;
            $plan->save();
            return response()->json(['success']);
        }else{

        }
    }

    public function borrar_plan(Request $request){
        $plan = SpecialityPlan::find($request->plan_id);
        if($plan != null){
            $plan->delete();
            return response()->json(['success']);
        }else{
            return response()->json(['errors'=>['general'=>'No se ha encontrado dicho plan.']], 422);
        }
    }
}
