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
            'password' => 'required|string|min:8|confirmed|regex:/^[a-zA-Z0123456789]+$/',
            'address' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            
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
            'password' => 'contraseña',
            'mobile' => 'celular',
            'photo' => 'foto'
        ];
    }
}
