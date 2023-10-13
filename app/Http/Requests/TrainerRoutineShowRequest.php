<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRoutineShowRequest extends FormRequest
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
            'trainerroutine_id'=>'required|exists:trainer_routines,id'
        ];
    }

    public function messages(){
        return [
            'trainerroutine_id.required'=>'Es necesario seleccionar una rutina.',
            'trainerroutine_id.exists'=>'No existe la rutina.'
        ];
    }
}
