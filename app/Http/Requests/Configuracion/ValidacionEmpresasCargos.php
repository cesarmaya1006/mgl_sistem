<?php

namespace App\Http\Requests\Configuracion;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionEmpresasCargos extends FormRequest
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
            'cargo' => 'required|max:150|unique:empresa_cargo,cargo,' . $this->route('id'),
        ];
    }
    public function attributes()
    {
        return [
            'cargo' => 'Cargo',

        ];
    }

    public function messages()
    {
        return [
            'cargo.required' => 'EL campo Cargo es obligatorio',
            'cargo.max' => 'EL campo Cargo no puede superar 100 caracteres',
            'cargo.unique' => 'EL campo Cargo ya se encuentra en la base de datos',

        ];
    }
}
