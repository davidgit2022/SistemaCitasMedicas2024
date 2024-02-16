<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|regex:/^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/',
            'lastName' => 'required|regex:/^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/',
            'email' => 'required|unique:users,email',
            'dni' => 'required|numeric|regex:/^[0123456789]+$/',
            'address' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'photo' => 'nullable|image|mimes:png,jpg'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'lastName' => 'apellido',
            'email' => 'correo electrónico',
            'dni' => 'cedula',
            'address' => 'dirección',
            'mobile' => 'cedular',
            'photo' => 'nullable'
        ];
    }
}
