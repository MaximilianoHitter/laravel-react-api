<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\TrainerStudent;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['trainers'=>Trainer::all()]);
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
    public function show($id_trainer)
    {
        $trainer = Trainer::find($id_trainer);
        return response()->json(['trainer'=>$trainer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainer $trainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainer $trainer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function get_students_requests($id_trainer)
    {
        $trainer = Trainer::with('students')->find($id_trainer);
        $peticiones = $trainer->students;
        return $peticiones;
    }
}
