<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRoutineStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'initial_date' => ['required', 'date', 'after_or_equal:today'],
            'final_date' => ['required', 'date', 'after_or_equal:today'],
            'name' => 'required',
            'descriptions' => 'required',
            'id_student' => 'required|exists:students,id',
            'id_student_goal' => 'required|exists:student_goals,id',
            'amount' => 'required|numeric|gt:0'
        ];
    }

    public function messages()
    {
        return [
            'initial_date.required' => 'Debe completar con una fecha inicial',
            'initial_date.after_or_equal' => 'La fecha inicial debe ser igual o mayor a la actual',
            'final_date.required' => 'Debe completar con una fecha final',
            'final_date.after_or_equal' => 'La fecha final debe ser igual o mayor a la actual',
            'name.required' => 'Debe ingresar un nombre',
            'id_student_goal.required' => 'Debe seleccionar un objetivo',
            'amount.required' => 'Debe ingresar un precio',
            'amount.numeric' => 'El precio debe ser un número',
            'amount.gt:0' => 'El precio debe ser mayor a cero'
        ];
    }
}
