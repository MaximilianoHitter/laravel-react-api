<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStoreRequest;
use App\Models\Payment;
use App\Models\Student;
use App\Models\TrainerRoutine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
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
        $payment->save();
        $routine = TrainerRoutine::find($request->trainerroutine_id);
        $routine->id_payment = $payment->id;
        $routine->save();
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
}
