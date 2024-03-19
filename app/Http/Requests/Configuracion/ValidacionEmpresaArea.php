<?php

namespace App\Http\Requests\Configuracion;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionEmpresaArea extends FormRequest
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
            'area' => 'required|max:150|unique:empresa_area,area,' . $this->route('id'),
        ];
    }
    public function attributes()
    {
        return [
            'area' => 'Área',

        ];
    }

    public function messages()
    {
        return [
            'area.required' => 'EL campo Área es obligatorio',
            'area.max' => 'EL campo Área no puede superar 100 caracteres',
            'area.unique' => 'EL campo Área ya se encuentra en la base de datos',

        ];
    }
}
