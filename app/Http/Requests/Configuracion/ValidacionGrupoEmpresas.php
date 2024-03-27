<?php

namespace App\Http\Requests\Configuracion;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionGrupoEmpresas extends FormRequest
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
            'identificacion' => 'required|max:100|unique:config_empresa,identificacion,' . $this->route('id'),
            'nombres' => 'required|max:150',
            'email' => 'required|max:150|unique:config_empresa,email,' . $this->route('id'),
            'telefono' => 'max:50',
            'direccion' => 'max:200',
            'contacto' => 'max:200',
            'cargo' => 'max:200',

        ];
    }
    public function attributes()
    {
        return [
            'identificacion' => 'Identificación',
            'nombres' => 'Nombres',
            'email' => 'Correo Electrónico',
            'telefono' => 'Teléfono',
            'direccion' => 'Dirección',
            'contacto' => 'Contacto',
            'cargo' => 'Cargo',

        ];
    }

    public function messages()
    {
        return [
            'identificacion.required' => 'EL campo Identificación es obligatorio',
            'identificacion.max' => 'EL campo Identificación no puede superar 100 caracteres',
            'identificacion.unique' => 'EL campo Identificación ya se encuentra en la base de datos',
            'nombres.required' => 'El nombre de la empresa es obligatorio',
            'nombres.max' => 'El nombre de la empresa no puede superar 150 caracteres',
            'email.required' => 'EL campo Correo Electrónico es obligatorio',
            'email.max' => 'EL Correo Electrónico no puede superar 150 caracteres',
            'email.unique' => 'EL Correo Electrónico ya se encuentra en la base de datos',
            'telefono.max' => 'El campo teléfono no puede superar 50 caracteres',
            'direccion.max' => 'El campo dirección no puede superar 200 caracteres',
            'contacto.max' => 'El campo contacto no puede superar 200 caracteres',
            'cargo.max' => 'El campo cargo no puede superar 200 caracteres',

        ];
    }
}
