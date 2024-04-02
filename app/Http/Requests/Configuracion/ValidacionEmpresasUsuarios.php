<?php

namespace App\Http\Requests\Configuracion;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionEmpresasUsuarios extends FormRequest
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
            'identificacion' => 'required|max:100|unique:config_usuario,identificacion,' . $this->route('id'),
            'email' => 'required|max:150|unique:config_usuario,email,' . $this->route('id'),

        ];
    }
    public function attributes()
    {
        return [
            'identificacion' => 'Identificación',
            'email' => 'Correo Electrónico',

        ];
    }

    public function messages()
    {
        return [
            'identificacion.required' => 'El campo Identificación es obligatorio',
            'identificacion.max' => 'El campo Identificación no puede superar 100 caracteres',
            'identificacion.unique' => 'El campo Identificación ya se encuentra en la base de datos',
            'email.required' => 'El campo Correo Electrónico es obligatorio',
            'email.max' => 'El campo Correo Electrónico no puede superar 100 caracteres',
            'email.unique' => 'El campo Correo Electrónico ya se encuentra en la base de datos',

        ];
    }
}
