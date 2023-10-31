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
        $cantidad_alumnos = TrainerStudent::where('trainer_id', $trainer->id)
            ->where('status_student_id', '2')
            ->count();
        $trainer->qty_students = $cantidad_alumnos;
        $certificates = Certificate::where('id_trainer', $trainer->id)
            ->get();
        $cantidad_certificados = Certificate::where('id_trainer', $trainer->id)
            ->count();
        $trainer->certificates = $certificates;
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
     * @lrd:start 
     * Este metodo hace cosas locas 
     * 
     * y aca metemo otra pelotude 
     * @lrd:end
     */
    public function get_students_requests()
    {
        $user_id = Auth::id();
        $trainer = Trainer::where('id_user', $user_id)->first();
        $request = TrainerStudent::where('trainer_id', $trainer->id)->with('student', 'status_student')->get();
        foreach ($request as $key => $value) {
            $request[$key]->name = $value->student->name.' '.$value->student->last_name;
        }
        return new GeneralCollection($request);
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
        $certificates = Certificate::where('id_trainer', $id_trainer)
            ->get();
        return new GeneralCollection($certificates);
    }

    public function get_trainer_data($id_trainer)
    {
        $trainer = Trainer::where('id_user', $id_trainer)
            ->first();
        $cantidad_alumnos = TrainerStudent::where('trainer_id', $trainer->id)
            ->where('status', 'Activo')
            ->count();
        $trainer->qty_students = $cantidad_alumnos;
        $cantidad_certificados = Certificate::where('id_trainer', $trainer->id)
            ->count();
        $trainer->qty_certificates = $cantidad_certificados;
        return response()->json(['data' => $trainer]);
    }

    public function change_student_status(Request $request){
        $relacion_id = $request->relation_id;
        $intermedia = TrainerStudent::find($relacion_id);
        if($intermedia != null){
            $intermedia->status_student_id = $request->estado_id;
            $intermedia->save();
            return response()->json(['success']);
        }else{
            return response()->json(['errors'=>['general'=>'algo paso']], 422);
        }
    }
}
