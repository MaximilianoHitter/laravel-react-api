<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStorePlanRequest;
use App\Http\Requests\PaymentStoreRequest;
use App\Http\Resources\GeneralCollection;
use App\Models\Payment;
use App\Models\Specialist;
use App\Models\SpecialityPlan;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMail;
use App\Models\User;
use Carbon\Carbon;

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
        $planes = SpecialityPlan::where('student_id', $student_id)->where('specialist_id', $specialist->id)->with('student', 'payment', 'status', 'specialist.branches')->get();
        $planes_format = [];
        foreach ($planes as $pl) {
            $plan = null;
            $plan = $pl;
            $fecha_final = Carbon::create($plan->final_date);
            $fecha_final->addDays(1);
            $plan->nueva_fecha_final = $fecha_final->format('Y-m-d');
            $planes_format[] = $plan;
        }
        return new GeneralCollection($planes_format);
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
        $asd = new CustomMail();
        $student = Student::find($request->student_id);
        $user_student = User::find($student->id_user);
        Mail::to($user_student->email)->send($asd->mailCreatePlan($specialist->name, $plan->name));
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

    public function get_plan(Request $request){
        $routine = SpecialityPlan::where('id', $request->specialist_plan_id)->with('specialist', 'specialist.branches')->first();
        return response()->json(['data'=>$routine]);
    }

    public function payment_store(PaymentStorePlanRequest $request){
        $user_id = Auth::id();
        $student = Student::where('id_user', $user_id)->first();
        $payment = new Payment();
        $payment->id_student = $student->id;
        $payment->amount = $request->amount;
        $payment->reason = $request->reason;
        $payment->payment_type = $request->payment_type;
        $payment->status = 'Ingresado';
        $files = $request->file('files');

        $path = [];
        if($files != null){
            foreach ($files as $key => $value) {
                $path[] = $value->store();
            }
        }else{
            $path[0] = '';
        }
        $payment->path_archivo = $path[0];
        $payment->save();
        $routine = SpecialityPlan::find($request->trainerroutine_id);
        $routine->id_payment = $payment->id;
        $routine->save();
        $asd = new CustomMail();/* 
        $student = Student::find($request->student_id); */
        $user_student = User::find(Auth::id());
        //mail para el student
        Mail::to($user_student->email)->send($asd->mailPaymentCreateStudent($routine->name));
        //mail pal specialist 
        $asd = null;
        $asd = new CustomMail();
        $specialist = Specialist::find($routine->specialist_id);
        $user_specialist = User::find($specialist->id_user);
        Mail::to($user_specialist->email)->send($asd->mailPaymentCreate($student->name, $routine->name));
        return response()->json(['data'=>'success'], 200);
    }

    public function set_feedback(Request $request){
        $plan = SpecialityPlan::find($request->id_plan);
        $plan->student_feedback = $request->feedback;
        $plan->save();
        return response()->json(['data'=>'success']);
    }

    public function ver_archivo($id_payment){
        $payment = Payment::find($id_payment);
        if($payment->path_archivo != ''){
            $path = storage_path('app/'.$payment->path_archivo);
            $file = new File($path);
            $base = 'data:image/'.$file->getExtension().";base64,".base64_encode(file_get_contents($file));
            return response()->json(['data'=>$base]);
        }else{
            return response()->json(['data'=>'']);
        }
        
    }
}
