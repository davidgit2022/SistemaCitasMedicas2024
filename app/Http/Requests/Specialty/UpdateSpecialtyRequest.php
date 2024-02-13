<?php

namespace App\Http\Requests\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpecialtyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $specialtyId = $this->route('specialty')->id;
        return [
            'name' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/|unique:specialties,name,' . $specialtyId
        ];

    }

    public function attributes():array
    {
        return [
            'name' => 'nombre especialidad',
        ];
    }
}
