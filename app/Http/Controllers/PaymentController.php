<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStoreRequest;
use App\Models\Payment;
use App\Models\Specialist;
use App\Models\SpecialityPlan;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\TrainerRoutine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMail;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $rol = $user->getRoleNames();
        $rol = $rol->toArray();
        $rol_string = implode(',', $rol);
        if(str_contains($rol_string, 'Especialista')){
            $routines_parsed = [];
            $student = Specialist::where('id_user', $user_id)->first();
            $routines = SpecialityPlan::where('specialist_id', $student->id)->where('id_payment', '!=', null)->with('payment', 'student')->get();
            return response()->json(['data'=>$routines]);
            foreach ($routines as $routine) {
                $obj = null;
                $obj = $routine;
                $obj->payment_identificator = $routine->id_payment;
                $obj->person_name = $routine->student->name;
                $obj->routine_name = $routine->name;
                $obj->payment_type = $routine->payment->payment_type;
                $obj->status = $routine->payment->status;
                $obj->payment->updated_at_parsed = $routine->payment->updated_at->format('d/m/Y');
                $routines_parsed[] = $obj;
            }
            return response()->json(['data'=>$routines_parsed]);
        }elseif(str_contains($rol_string, 'Trainer')){
            $trainer = Trainer::where('id_user', $user_id)->first();
            $routines = TrainerRoutine::where('id_trainer', $trainer->id)->where('id_payment', '!=', null)->with('payment', 'student')->get();
            $routines_parsed = [];
            foreach ($routines as $routine) {
                $obj = null;
                $obj = $routine;
                $obj->payment_identificator = $routine->payment->id;
                $obj->person_name = $routine->student->name;
                $obj->routine_name = $routine->name;
                $obj->payment_type = $routine->payment->payment_type;
                $obj->status = $routine->payment->status;
                $obj->payment->updated_at_parsed = $routine->payment->updated_at->format('d/m/Y');
                $routines_parsed[] = $obj;
            }
            return response()->json(['data'=>$routines_parsed]);
        }
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
    public function store(PaymentStoreRequest $request)
    {
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
        $routine = TrainerRoutine::find($request->trainerroutine_id);
        $routine->id_payment = $payment->id;
        $routine->save();
        $asd = new CustomMail();
        $trainer = Trainer::find($routine->id_trainer);
        $user_trainer = User::find($trainer->id_user);
        //envio de mail al trainer
        Mail::to($user_trainer->email)->send($asd->mailPaymentCreate($student->name, $routine->name));
        //envio de mail al estudiante
        $asd = null;
        $asd = new CustomMail();
        $user_student = User::find($user_id);
        Mail::to($user_student->email)->send($asd->mailPaymentCreateStudent($routine->name));
        return response()->json(['data'=>'success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function change_status(Request $request){
        $id_payment = $request->payment_id;
        $payment_status = $request->payment_status;
        $estados = [1=>'Iniciado', 2=>"Aceptado", 3=>"Cancelado"];
        $payment = Payment::find($id_payment);
        $payment->status = $estados[$payment_status];
        $payment->save();
        return response()->json(['data'=>'success'], 200);
    }
}
