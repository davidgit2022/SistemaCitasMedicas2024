<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $doctorId = $this->route('doctor')->id;
        return [
            'name' => 'required|regex:/^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/',
            'lastName' => 'required|regex:/^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/',
            'email' => 'required|unique:users,email,' . $doctorId,
            'specialties' => 'required',
            //'password' => 'required',
            'dni' => 'required|numeric|regex:/^[0123456789]+$/unique:users,dni,' . $doctorId,
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
            'dni' => 'cedula',
            'address' => 'dirección',
            'mobile' => 'celular',
            'photo' => 'foto'
        ];
    }
}
