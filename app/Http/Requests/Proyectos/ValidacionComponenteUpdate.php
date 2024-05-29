<?php

namespace App\Http\Requests\Proyectos;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionComponenteUpdate extends FormRequest
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
            'adicion' => 'nullable|not_in:0',
        ];
    }
    public function attributes()
    {
        return [
            'adicion' => 'Adicion',

        ];
    }

    public function messages()
    {
        return [
            'identificacion.not_in' => 'La adición no puede ser 0, verifique en intentelo de nuevo',
        ];
    }
}
