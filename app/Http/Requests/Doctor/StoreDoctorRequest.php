<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'specialties' => 'required',
            'password' => 'required|string|min:8|confirmed|regex:/^[a-zA-Z0123456789]+$/',
            'dni' => 'required|numeric|regex:/^[0123456789]+$/',
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
            'specialties' => 'especialidad',
            'password' => 'contraseña',
            'dni' => 'cedula',
            'address' => 'dirección',
            'mobile' => 'celular',
            'photo' => 'foto'
        ];
    }
}
