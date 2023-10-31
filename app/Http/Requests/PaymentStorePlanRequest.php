<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStorePlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'specialist_plan_id'=>'required|exists:speciality_plans,id',
            'amount'=>'required|numeric',
            'reason'=>'required|string',
            'payment_type'=>'required|string'
        ];
    }

    public function messages(){
        return [
            'reason.required'=>'El campo Descripción es requerido.',
            'payment_type.required'=>'El campo Tipo de Pago es requerido.'
        ];    
    }
}
