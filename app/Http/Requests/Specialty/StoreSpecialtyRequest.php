<?php

namespace App\Http\Requests\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialtyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:specialties,name|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre especialidad',
        ];
    }
}
