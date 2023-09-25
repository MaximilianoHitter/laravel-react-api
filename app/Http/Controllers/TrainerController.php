<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralCollection;
use App\Http\Resources\StudentRoutineCollection;
use App\Http\Resources\TrainerCollection;
use App\Models\Certificate;
use App\Models\Trainer;
use App\Models\TrainerStudent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    private $estados = [
        1 => 'Activo',
        2 => 'Inactivo',
        3 => 'Cancelado'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['trainers' => Trainer::all()]);
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
        $cantidad_alumnos = TrainerStudent::where('trainer_id', $trainer->id)->where('status', 'Activo')->count();
        $trainer->qty_students = $cantidad_alumnos;
        $cantidad_certificados = Certificate::where('id_trainer', $trainer->id)->count();
        $trainer->qty_certificates = $cantidad_certificados;
        return response()->json($trainer);
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
    public function get_students_requests()
    {
        $user_id = Auth::id();
        try {
            $trainer = Trainer::where('id_user', $user_id)->first();
        } catch (\Throwable $th) {
            return [];
        }
        $peticiones = $trainer->students;
        $salida = [];
        foreach ($peticiones as $key => $value) {
            $value->status = $value->pivot->status;
            $value->date = $value->pivot->date;
            $value->pivot_id = $value->pivot->id;
            $salida[] = $value;
        }
        return $salida;
    }

    public function change_status(Request $request)
    {
        $id_tupla = $request->id_tupla;
        $estado = $request->estado;
        $nuevo_estado = $this->estados[$estado];
        $tupla = TrainerStudent::find($id_tupla);
        $tupla->status = $nuevo_estado;
        $tupla->date = Carbon::now()->format('Y-m-d');
        $tupla->save();
        return response()->json(['data' => 'success'], 200);
    }

    public function get_certificates($id_trainer)
    {
        $certificates = Certificate::where('id_trainer', $id_trainer)->get();
        return new GeneralCollection($certificates);
    }
}
