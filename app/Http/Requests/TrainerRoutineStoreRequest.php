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
            'descriptions' => 'required|array',
            'id_student' => 'required|exists:students,id',
            'id_student_goal' => 'required|exists:student_goals,id',
            'amount' => 'required|numeric|gt:0'
        ];
    }
}
