<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralCollection;
use App\Models\Specialist;
use App\Models\SpecialistStudent;
use App\Models\SpecialityPlan;
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
            $value->status = $value->pivot->status;
            $value->date = $value->pivot->date;
            $value->pivot_id = $value->pivot->id;
            $salida[] = $value;
        }
        return new GeneralCollection($salida);
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
    public function show(Specialist $specialist)
    {
        //
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
}
